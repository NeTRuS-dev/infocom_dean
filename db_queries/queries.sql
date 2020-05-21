SELECT `group`.`name` as `Группа`, `subject`.`name` as `Предмет`, AVG(`mark`.`value`) as `Средняя оценка`
FROM `group`
         INNER JOIN `student` ON `group`.`id` = `student`.`group_id`
         INNER JOIN `academic_plan` ON `student`.`academic_plan_id` = `academic_plan`.`id`
         INNER JOIN `subject_academic_plan` ON `subject_academic_plan`.`academic_plan_id` = `academic_plan`.`id`
         INNER JOIN `subject` ON `subject_academic_plan`.`subject_id` = `subject`.`id`
         INNER JOIN `mark` ON `mark`.`subject_id` = `subject`.`id` AND `mark`.`value` IS NOT NULL
GROUP BY `group`.`name`, `subject`.`name`;

--
SET @beginning = CAST("2017-08-29 00:00:00" AS DATETIME);
SET @ending = CAST("2020-08-29 00:00:00" AS DATETIME);
SELECT `group`.`name`,
       `student`.`name`,
       `student`.`surname`,
       `student`.`patronymic`
FROM `subject`
         INNER JOIN `subject_academic_plan` ON `subject`.`id` = `subject_academic_plan`.`subject_id`
         INNER JOIN `academic_plan` ON `academic_plan`.`id` = `subject_academic_plan`.`academic_plan_id`
         INNER JOIN `student` ON `academic_plan`.`id` = `student`.`academic_plan_id`
         INNER JOIN `group` ON `group`.`id` = `student`.`group_id`
         INNER JOIN `mark` ON `mark`.`student_id` = `student`.`id` AND `mark`.`valuation_date` >= @beginning AND
                              `mark`.`valuation_date` <= @ending
WHERE `mark`.`absent` = 1
   OR `mark`.`value` = 2
GROUP BY `group`.`name`,
         `student`.`name`,
         `student`.`surname`,
         `student`.`patronymic`;

--

-- SELECT LEFT('abffagpokejfkjs', LENGTH('hello'))
SET @name_pattern = 'Э';
SET @surname_pattern = 'М';
SET @patronymic_pattern = 'И';
SELECT *
FROM `student`
WHERE `student`.`name` LIKE CONCAT(@name_pattern, '%')
  AND `student`.`surname` LIKE CONCAT(@surname_pattern, '%')
  AND `student`.`patronymic` LIKE CONCAT(@patronymic_pattern, '%');


--

SELECT `student`.`name` as `Имя студента`,
       `student`.`surname` as `Фамилия студента`,
       `student`.`patronymic` as `Отчёство студента`,
       AVG(`mark`.`value`) as `Средняя оценка`,
       (COUNT(`mark`.`absent`) / COUNT(*)) as `Пропуски`
FROM `group`
         INNER JOIN `student` ON `group`.`id` = `student`.`group_id`
         INNER JOIN `academic_plan` ON `student`.`academic_plan_id` = `academic_plan`.`id`
         INNER JOIN `subject_academic_plan` ON `subject_academic_plan`.`academic_plan_id` = `academic_plan`.`id`
         INNER JOIN `subject` ON `subject_academic_plan`.`subject_id` = `subject`.`id`
         INNER JOIN `mark` ON `mark`.`subject_id` = `subject`.`id`
GROUP BY `student`.`name`, `student`.`surname`, `student`.`patronymic`
HAVING AVG(`mark`.`value`) > 2.75
   AND (COUNT(`mark`.`absent`) / COUNT(*)) > 0.3;
-- TODO пропущенные занятия