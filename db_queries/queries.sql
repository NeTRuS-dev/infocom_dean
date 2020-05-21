SELECT `group`.`name` as `Группа`, `subject`.`name` as `Предмет`, AVG(`mark`.`value`) as `Средняя оценка`
FROM `group`
         INNER JOIN `student` ON `group`.`id` = `student`.`group_id`
         INNER JOIN `academic_plan` ON `student`.`academic_plan_id` = `academic_plan`.`id`
         INNER JOIN `subject_academic_plan` ON `subject_academic_plan`.`academic_plan_id` = `academic_plan`.`id`
         INNER JOIN `subject` ON `subject_academic_plan`.`subject_id` = `subject`.`id`
         INNER JOIN `mark` ON `mark`.`subject_id` = `subject`.`id`
GROUP BY `group`.`name`, `subject`.`name`;

--
SET @beginning = '';
SET @ending = '';
SELECT `group`.`name`, `student`.`name`, `student`.`surname`, `student`.`patronymic`
FROM `subject`
         INNER JOIN `subject_academic_plan` ON `subject`.`id` = `subject_academic_plan`.`subject_id`
         INNER JOIN `academic_plan` ON `academic_plan`.`id` = `subject_academic_plan`.`academic_plan_id`
         INNER JOIN `student` ON `academic_plan`.`id` = `student`.`academic_plan_id`
         INNER JOIN `group` ON `group`.`id` = `student`.`group_id`
         INNER JOIN `mark` ON `mark`.`student_id` = `student`.`id` AND `mark`.`valuation_date` >= @beginning AND
                              `mark`.`valuation_date` <= @ending
WHERE `mark`.`value` = 0
   OR `mark`.`value` = 2;
-- TODO добавить границы

--

-- SELECT LEFT('abffagpokejfkjs', LENGTH('hello'))
SET @name_pattern = '';
SET @surname_pattern = '';
SET @patronymic_pattern = '';
SELECT *
FROM student
WHERE LEFT(student.name, LENGTH(@name_pattern)) = @name_pattern
  AND LEFT(student.surname, LENGTH(@surname_pattern)) = @surname_pattern
  AND LEFT(student.patronymic, LENGTH(@patronymic_pattern)) = @patronymic_pattern;


--

SELECT `student`.`name` as `Имя студента`
FROM `group`
         INNER JOIN `student` ON `group`.`id` = `student`.`group_id`
         INNER JOIN `academic_plan` ON `student`.`academic_plan_id` = `academic_plan`.`id`
         INNER JOIN `subject_academic_plan` ON `subject_academic_plan`.`academic_plan_id` = `academic_plan`.`id`
         INNER JOIN `subject` ON `subject_academic_plan`.`subject_id` = `subject`.`id`
         INNER JOIN `mark` ON `mark`.`subject_id` = `subject`.`id`
GROUP BY `student`.`name`
HAVING AVG(`mark`.`value`) > 2.75
   AND (COUNT(`mark`.`absent`) / COUNT(*)) > 0.3
-- TODO пропущенные занятия