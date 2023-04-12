CREATE TABLE Users (
	UserID NUMERIC(10) NOT NULL AUTO_INCREMENT = 2023502400,
	CONSTRAINT Users_pk PRIMARY KEY (UserID),
	Username VARCHAR(25) NOT NULL,
	Password VARCHAR(25) NOT NULL,
	Name VARCHAR(50) NOT NULL,
	JoinDate DATE NOT NULL,
	Email VARCHAR(50) NOT NULL
);

CREATE TABLE MetaData (
	TagID NUMERIC(5) NOT NULL AUTO_INCREMENT = 66600,
	TagType VARCHAR(20) NOT NULL,
	CONSTRAINT MetaData_PK PRIMARY KEY (TagID, TagType)
);

CREATE TABLE SurveyDetails (
	SurveyID NUMERIC(10) NOT NULL AUTO_INCREMENT = 2023421900,
	CONSTRAINT SurveyDetails_PK PRIMARY KEY (SurveyID),
	SurveyName VARCHAR(50) NOT NULL,
	CreationDate DATE NOT NULL,
	UploadStatus CHAR(1) NOT NULL,
	CONSTRAINT Check_Upload CHECK (UploadStatus = 'Y' or UploadStatus = 'N'),
	UploadDate DATE,
	Users_UserID NUMERIC(10) NOT NULL,
	CONSTRAINT SurveyDetails_Users_FK FOREIGN KEY (Users_UserID) REFERENCES (UserID),
	MetaData_TagID NUMERIC(5) NOT NULL,
	MetaData_TagType VARCHAR(20) NOT NULL,
	CONSTRAINT SurveyDetails_MetaData_FK FOREIGN KEY (MetaData_TagID, MetaData_TagType) REFERENCES (TagID, TagType)
);

CREATE TABLE SurveyQuestions (
	QuestionNumber NUMERIC(2) NOT NULL,
	QuestionName VARCHAR(250) NOT NULL,
	QuestionType CHAR(2) NOT NULL,
	QuestionStatus CHAR(1) NOT NULL,
	SurveyDetails_SurveyID NUMERIC(10) NOT NULL,
	CONSTRAINT SurveyQuestions_SurveyDetails_FK FOREIGN KEY (SurveyDetails_SurveyID) REFERENCES (SurveyID)
);

CREATE TABLE SurveyAnswers (
	QuestionNumber NUMERIC(2) NOT NULL,
	QuestionAnswer TEXT NOT NULL,
	SurveyQuestions_QuestionName VARCHAR(250) NOT NULL,
	SurveyAnswers_SurveyQuestions_FK FOREIGN KEY (SurveyQuestions_QuestionName) REFERENCES (QuestionName),
	SurveyDetails_SurveyID NUMERIC(10) NOT NULL,
	SurveyAnswers_SurveyDetails_FK FOREIGN KEY (SurveyDetails_SurveyID) REFERENCES (SurveyID)
);