CREATE VIEW grade_point_average_in_group AS
SELECT `group`.`name` as `Группа`, `subject`.`name` as `Предмет`, AVG(`mark`.`value`) as `Средняя оценка`
FROM `group`
         INNER JOIN `student` ON `student`.`deleted` = 0 AND `group`.`id` = `student`.`group_id`
         INNER JOIN `academic_plan` ON `student`.`academic_plan_id` = `academic_plan`.`id`
         INNER JOIN `subject_academic_plan` ON `subject_academic_plan`.`academic_plan_id` = `academic_plan`.`id`
         INNER JOIN `subject` ON `subject_academic_plan`.`subject_id` = `subject`.`id`
         INNER JOIN `mark` ON `mark`.`subject_id` = `subject`.`id` AND `mark`.`value` IS NOT NULL
GROUP BY `group`.`name`, `subject`.`name`;

--
# SET @beginning = CAST("2017-08-29 00:00:00" AS DATETIME);
# SET @ending = CAST("2020-08-29 00:00:00" AS DATETIME);


DELIMITER //

CREATE PROCEDURE GetIdiotsInTimeRange(IN beginning DATETIME,
                                      IN ending DATETIME)
BEGIN
    SELECT `group`.`name`,
           `student`.`name`,
           `student`.`surname`,
           `student`.`patronymic`
    FROM `subject`
             INNER JOIN `subject_academic_plan` ON `subject`.`id` = `subject_academic_plan`.`subject_id`
             INNER JOIN `academic_plan` ON `academic_plan`.`id` = `subject_academic_plan`.`academic_plan_id`
             INNER JOIN `student` ON `student`.`deleted` = 0 AND `academic_plan`.`id` = `student`.`academic_plan_id`
             INNER JOIN `group` ON `group`.`id` = `student`.`group_id`
             INNER JOIN `mark` ON `mark`.`student_id` = `student`.`id` AND `mark`.`valuation_date` >= beginning AND
                                  `mark`.`valuation_date` <= ending
    WHERE `mark`.`absent` = 1
       OR `mark`.`value` = 2
    GROUP BY `group`.`name`,
             `student`.`name`,
             `student`.`surname`,
             `student`.`patronymic`;
END //

DELIMITER ;
--

DELIMITER //

CREATE PROCEDURE GetStudentsByNames(IN name_pattern VARCHAR(255),
                                    IN surname_pattern VARCHAR(255),
                                    IN patronymic_pattern VARCHAR(255))
BEGIN
    SELECT `student`.`id`         AS `Идентификатор студента`,
           `group`.`name`         AS `Группа`,
           `student`.`name`       AS `Имя`,
           `student`.`surname`    AS `Фамилия`,
           `student`.`patronymic` AS `Отчество`
    FROM `student`
             LEFT JOIN `group` ON `group`.`id` = `student`.`group_id`
    WHERE `student`.`deleted` = 0
      AND `student`.`name` LIKE CONCAT(name_pattern, '%')
      AND `student`.`surname` LIKE CONCAT(surname_pattern, '%')
      AND `student`.`patronymic` LIKE CONCAT(patronymic_pattern, '%')
    GROUP BY `student`.`id`,
             `group`.`name`,
             `student`.`name`,
             `student`.`surname`,
             `student`.`patronymic`;
END //

DELIMITER ;

--

SELECT `student`.`name`                                                              as `Имя студента`,
       `student`.`surname`                                                           as `Фамилия студента`,
       `student`.`patronymic`                                                        as `Отчёство студента`,
       AVG(`mark`.`value`)                                                           as `Средняя оценка`,
       (COUNT(CASE WHEN `mark`.`absent` >= 1 THEN 1 ELSE NULL END) / COUNT(*)) * 100 as `Процент пропусков`
FROM `group`
         INNER JOIN `student` ON `student`.`deleted` = 0 AND `group`.`id` = `student`.`group_id`
         INNER JOIN `academic_plan` ON `student`.`academic_plan_id` = `academic_plan`.`id`
         INNER JOIN `subject_academic_plan` ON `subject_academic_plan`.`academic_plan_id` = `academic_plan`.`id`
         INNER JOIN `subject` ON `subject_academic_plan`.`subject_id` = `subject`.`id`
         INNER JOIN `mark` ON `mark`.`subject_id` = `subject`.`id`
GROUP BY `student`.`name`, `student`.`surname`, `student`.`patronymic`
HAVING AVG(`mark`.`value`) > 2.75
   AND (COUNT(CASE WHEN `mark`.`absent` >= 1 THEN 1 ELSE NULL END) / COUNT(*)) > 0.3;

--
DELIMITER //

CREATE PROCEDURE UpCourseForGroupMembers(
    IN target_group_id INT
)
BEGIN
    SET @target_group_course_number = (SELECT `course_number`
                                       FROM `group`
                                       WHERE `group`.`id` = target_group_id);
    SET @target_group_specialty_id = (SELECT `specialty_id`
                                      FROM `group`
                                      WHERE `group`.`id` = target_group_id);
    SET @new_group_id = (SELECT `group`.`id`
                         FROM `group`
                         WHERE `group`.`course_number` = @target_group_course_number
                           AND `group`.`id` != target_group_id
                         LIMIT 1);
    IF ISNULL(@new_group_id) THEN
        INSERT `group`(`name`, `course_number`, `specialty_id`)
        VALUES (LEFT(MD5(RAND()), 7), @target_group_course_number, @target_group_specialty_id);
        SET @new_group_id = LAST_INSERT_ID();
    END IF;


    CREATE TEMPORARY TABLE `student_ids_to_stay_back`
    SELECT `student`.`id` as `id`
    FROM `group`
             INNER JOIN `student`
                        ON `student`.`deleted` = 0 AND `group`.`id` = target_group_id AND
                           `group`.`id` = `student`.`group_id`
             INNER JOIN `academic_plan` ON `student`.`academic_plan_id` = `academic_plan`.`id`
             INNER JOIN `subject_academic_plan`
                        ON `subject_academic_plan`.`academic_plan_id` = `academic_plan`.`id`
             INNER JOIN `subject` ON `subject_academic_plan`.`subject_id` = `subject`.`id`
             INNER JOIN `mark` ON `mark`.`subject_id` = `subject`.`id`
             LEFT JOIN `history_of_academic_leaves` ON `history_of_academic_leaves`.`student_id` = `student`.`id` AND
                                                       `history_of_academic_leaves`.`date_of_beginning` <= CURDATE() AND
                                                       `history_of_academic_leaves`.`date_of_ending` >= CURDATE()
    WHERE `history_of_academic_leaves`.`id` IS NULL
    GROUP BY `student`.`id`
    HAVING AVG(`mark`.`value`) <= 2.75
        OR (COUNT(CASE WHEN `mark`.`absent` >= 1 THEN 1 ELSE NULL END) / COUNT(*)) <= 0.3;

    UPDATE `student`
    SET `student`.`group_id` = @new_group_id
    WHERE `student`.`deleted` = 0
      AND `student`.`id` in (SELECT `id` FROM `student_ids_to_stay_back`);

    DROP TEMPORARY TABLE `student_ids_to_stay_back`;

    UPDATE `group`
    SET `group`.`course_number` = `group`.`course_number` + 1
    WHERE `group`.`id` = target_group_id;
END //

DELIMITER ;

--

DELIMITER //

CREATE PROCEDURE MoveStudentToOtherGroup(IN target_student_id INT,
                                         IN target_group_id INT)
BEGIN
    INSERT INTO `history_of_group_changing`(`course_number`, `previous_group_id`, `new_group_id`, `student_id`)
    values ((SELECT `group`.`course_number`, `student`.`group_id`
             FROM `student`
                      INNER JOIN `group` ON `student`.`group_id` = `group`.`id`
             WHERE `student`.`deleted` = 0
               AND `student`.`id` = target_student_id),
            target_group_id, target_student_id);
    UPDATE `student`
    SET `student`.`group_id`=target_group_id
    WHERE `student`.`deleted` = 0
      AND `student`.`id` = target_student_id;

END //

DELIMITER ;

--

DELIMITER //

CREATE PROCEDURE DeleteStudent(IN target_student_id INT)
BEGIN
    UPDATE `student`
    SET `student`.`deleted` = 1
    WHERE `student`.`id` = target_student_id;

END //

DELIMITER ;

