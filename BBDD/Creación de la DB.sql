CREATE DATABASE [AnonymousSurveys];
GO
USE [AnonymousSurveys];

/*******************************************************************************************************************
	SCRIPT		: Eliminación de restricciones FOREIGN KEY
*******************************************************************************************************************/
ALTER TABLE sections
DROP CONSTRAINT FK_sections_survey;

ALTER TABLE questions
DROP CONSTRAINT FK_questions_section;

ALTER TABLE question_alternatives
DROP CONSTRAINT FK_question_alternatives_question;

ALTER TABLE question_alternatives
DROP CONSTRAINT FK_question_alternatives_alternative;

ALTER TABLE answers
DROP CONSTRAINT FK_answers_question;

ALTER TABLE group_questions
DROP CONSTRAINT FK_group_questions_group_1;

ALTER TABLE group_questions
DROP CONSTRAINT FK_group_questions_question;

ALTER TABLE group_alternatives
DROP CONSTRAINT FK_group_questions_group_2;

ALTER TABLE group_alternatives
DROP CONSTRAINT FK_group_questions_alternative;

/*******************************************************************************************************************
  TIPO             : TABLE
  NOMBRE           : surveys
  AUTOR            : RICARDO LLANOS
  FECHA CREACION   : 2026/03/05
  MOTIVO           : Creación de la tabla principal de encuestas
*******************************************************************************************************************/
IF EXISTS(
	SELECT name
	FROM sys.tables
	WHERE name = 'surveys'
)
BEGIN
	DROP TABLE surveys;
END
GO

CREATE TABLE surveys(
	id INT IDENTITY(1,1),
	title VARCHAR(50) NOT NULL,
	description VARCHAR(300) DEFAULT NULL,
	init_date DATETIME2 DEFAULT(GETDATE()) NOT NULL,
	end_date DATETIME2 NOT NULL,
	state BIT DEFAULT 1,

	created_at DATETIME2 DEFAULT(GETDATE()),
	modified_at DATETIME2 DEFAULT(GETDATE()),

	PRIMARY KEY (id)
);

GO
/*******************************************************************************************************************
  TIPO             : TABLE
  NOMBRE           : sections
  AUTOR            : RICARDO LLANOS
  FECHA CREACION   : 2026/03/05
  MOTIVO           : Creación de la tabla de secciones
  RELACIÓN		   : Presenta una relación M:1 con la tabla surveys
*******************************************************************************************************************/
IF EXISTS(
	SELECT name
	FROM sys.tables
	WHERE name = 'sections'
)
BEGIN
	DROP TABLE sections;
END
GO

CREATE TABLE sections(
	id INT IDENTITY(1,1),
	survey_id INT,
	title VARCHAR(50) NOT NULL,
	description VARCHAR(300) DEFAULT NULL,

	created_at DATETIME2 DEFAULT(GETDATE()),
	modified_at DATETIME2 DEFAULT(GETDATE()),

	PRIMARY KEY (id),
	--FOREIGN KEY (survey_id) REFERENCES [surveys](id) ON DELETE CASCADE (Al final)
);

GO
/*******************************************************************************************************************
  TIPO             : TABLE
  NOMBRE           : sections
  AUTOR            : RICARDO LLANOS
  FECHA CREACION   : 2026/03/05
  MOTIVO           : Creación de la tabla de preguntas
  RELACIÓN		   : Presenta una relación M:1 con la tabla sections
*******************************************************************************************************************/
IF EXISTS(
	SELECT name
	FROM sys.tables
	WHERE name = 'questions'
)
BEGIN
	DROP TABLE questions;
END
GO

CREATE TABLE questions(
	id INT IDENTITY(1,1),
	section_id INT,
	title VARCHAR(200) NOT NULL,
	
	created_at DATETIME2 DEFAULT(GETDATE()),
	modified_at DATETIME2 DEFAULT(GETDATE()),

	PRIMARY KEY (id),
	--FOREIGN KEY (section_id) REFERENCES [sections](id) ON DELETE CASCADE
);

GO
/*******************************************************************************************************************
  TIPO             : TABLE
  NOMBRE           : alternatives
  AUTOR            : RICARDO LLANOS
  FECHA CREACION   : 2026/03/05
  MOTIVO           : Creación de la tabla de alternativas
  RELACIÓN		   : Presenta una relación M:N con la tabla questions
*******************************************************************************************************************/
IF EXISTS(
	SELECT name
	FROM sys.tables
	WHERE name = 'alternatives'
)
BEGIN
	DROP TABLE alternatives;
END
GO

CREATE TABLE alternatives(
	id INT IDENTITY(1,1),
	name VARCHAR(200),

	created_at DATETIME2 DEFAULT(GETDATE()),
	modified_at DATETIME2 DEFAULT(GETDATE()),

	PRIMARY KEY(id)
);

GO
/*******************************************************************************************************************
  TIPO             : TABLE
  NOMBRE           : question_alternatives
  AUTOR            : RICARDO LLANOS
  FECHA CREACION   : 2026/03/05
  MOTIVO           : Creación de la tabla pivote u intermedia entre las preguntas y alternativas
*******************************************************************************************************************/
IF EXISTS(
	SELECT name
	FROM sys.tables
	WHERE name = 'question_alternatives'
)
BEGIN
	DROP TABLE question_alternatives;
END
GO

CREATE TABLE question_alternatives(
	question_id INT,
	alternative_id INT,

	created_at DATETIME2 DEFAULT(GETDATE()),
	modified_at DATETIME2 DEFAULT(GETDATE()),

	PRIMARY KEY (question_id,alternative_id),
	--FOREIGN KEY (question_id) REFERENCES [questions](id) ON DELETE CASCADE,
	--FOREIGN KEY (alternative_id) REFERENCES [alternatives](id) ON DELETE CASCADE
);

GO
/*******************************************************************************************************************
  TIPO             : TABLE
  NOMBRE           : answers
  AUTOR            : RICARDO LLANOS
  FECHA CREACION   : 2026/03/05
  MOTIVO           : Creación de la tabla de preguntas
  RELACIÓN		   : Presenta una relación M:1 con la tabla questions
*******************************************************************************************************************/
IF EXISTS(
	SELECT name
	FROM sys.tables
	WHERE name = 'answers'
)
BEGIN
	DROP TABLE answers;
END
GO

CREATE TABLE answers(
	id INT IDENTITY(1,1),
	question_id INT,
	content VARCHAR(200),

	created_at DATETIME2 DEFAULT(GETDATE()),
	modified_at DATETIME2 DEFAULT(GETDATE()),

	PRIMARY KEY (id),
	--FOREIGN KEY (question_id) REFERENCES [questions](id) ON DELETE CASCADE
);

GO
/*******************************************************************************************************************
  TIPO             : TABLE
  NOMBRE           : groups
  AUTOR            : RICARDO LLANOS
  FECHA CREACION   : 2026/03/05
  MOTIVO           : Creación de la tabla de preguntas
  RELACIÓN		   : Presenta una relación M:1 con la tabla sections
  RELACIÓN		   : Presenta una relación M:N con la tabla groups
*******************************************************************************************************************/
IF EXISTS(
	SELECT name
	FROM sys.tables
	WHERE name = 'groups'
)
BEGIN
	DROP TABLE groups;
END
GO

CREATE TABLE groups(
	id INT IDENTITY(1,1),
	
	created_at DATETIME2 DEFAULT(GETDATE()),
	modified_at DATETIME2 DEFAULT(GETDATE()),
	
	PRIMARY KEY (id)
);

GO
/*******************************************************************************************************************
  TIPO             : TABLE
  NOMBRE           : group_questions
  AUTOR            : RICARDO LLANOS
  FECHA CREACION   : 2026/03/05
  MOTIVO           : Creación de la tabla intermedia u pivote entre los grupos y preguntas
*******************************************************************************************************************/
IF EXISTS(
	SELECT name
	FROM sys.tables
	WHERE name = 'group_questions'
)
BEGIN
	DROP TABLE group_questions;
END
GO

CREATE TABLE group_questions(
	group_id INT,
	question_id INT,

	created_at DATETIME2 DEFAULT(GETDATE()),
	modified_at DATETIME2 DEFAULT(GETDATE()),

	PRIMARY KEY (group_id,question_id),
	--FOREIGN KEY (group_id) REFERENCES [groups](id) ON DELETE CASCADE,
	--FOREIGN KEY (question_id) REFERENCES [questions](id) ON DELETE CASCADE
);

GO
/*******************************************************************************************************************
  TIPO             : TABLE
  NOMBRE           : sections
  AUTOR            : RICARDO LLANOS
  FECHA CREACION   : 2026/03/05
  MOTIVO           : Creación de la tabla de preguntas
  RELACIÓN		   : Creación de la tabla intermedia u pivote entre los grupos y alternativas
*******************************************************************************************************************/
IF EXISTS(
	SELECT name
	FROM sys.tables
	WHERE name = 'group_alternatives'
)
BEGIN
	DROP TABLE group_alternatives;
END
GO

CREATE TABLE group_alternatives(
	group_id INT,
	alternative_id INT,

	created_at DATETIME2 DEFAULT(GETDATE()),
	modified_at DATETIME2 DEFAULT(GETDATE()),

	PRIMARY KEY (group_id,alternative_id),
	--FOREIGN KEY (group_id) REFERENCES [groups](id) ON DELETE CASCADE,
	--FOREIGN KEY (alternative_id) REFERENCES [alternatives](id) ON DELETE CASCADE
);

/*******************************************************************************************************************
	SCRIPT		: Eliminación de restricciones FOREIGN KEY
*******************************************************************************************************************/
ALTER TABLE sections
ADD CONSTRAINT FK_sections_survey
FOREIGN KEY (survey_id) REFERENCES [surveys](id) ON DELETE CASCADE;

ALTER TABLE questions
ADD CONSTRAINT FK_questions_section
FOREIGN KEY (section_id) REFERENCES [sections](id) ON DELETE CASCADE;

ALTER TABLE question_alternatives
ADD CONSTRAINT FK_question_alternatives_question
FOREIGN KEY (question_id) REFERENCES [questions](id) ON DELETE CASCADE;

ALTER TABLE question_alternatives
ADD CONSTRAINT FK_question_alternatives_alternative
FOREIGN KEY (alternative_id) REFERENCES [alternatives](id) ON DELETE CASCADE;

ALTER TABLE answers
ADD CONSTRAINT FK_answers_question
FOREIGN KEY (question_id) REFERENCES [questions](id) ON DELETE CASCADE;

ALTER TABLE group_questions
ADD CONSTRAINT FK_group_questions_group_1
FOREIGN KEY (group_id) REFERENCES [groups](id) ON DELETE CASCADE;

ALTER TABLE group_questions
ADD CONSTRAINT FK_group_questions_question
FOREIGN KEY (question_id) REFERENCES [questions](id) ON DELETE CASCADE;

ALTER TABLE group_alternatives
ADD CONSTRAINT FK_group_questions_group_2
FOREIGN KEY (group_id) REFERENCES [groups](id) ON DELETE CASCADE;

ALTER TABLE group_alternatives
ADD CONSTRAINT FK_group_questions_alternative
FOREIGN KEY (alternative_id) REFERENCES [alternatives](id) ON DELETE CASCADE;