CREATE TABLE member (
  idmember INTEGER   NOT NULL ,
  mid INTEGER    ,
  mpassword INTEGER    ,
  mname INTEGER    ,
  address INTEGER    ,
  balance INTEGER      ,
PRIMARY KEY(idmember));




CREATE TABLE platform (
  idplatform INTEGER   NOT NULL ,
  platformname VARCHAR(30)      ,
PRIMARY KEY(idplatform));




CREATE TABLE gametype (
  idgametype INTEGER   NOT NULL ,
  gametype VARCHAR(30)      ,
PRIMARY KEY(idgametype));




CREATE TABLE devcompany (
  iddevcompany INTEGER   NOT NULL ,
  devcompanyname VARCHAR(30)   NOT NULL   ,
PRIMARY KEY(iddevcompany));




CREATE TABLE game (
  idgame INTEGER   NOT NULL ,
  gid VARCHAR(8)   NOT NULL ,
  idgametype INTEGER   NOT NULL ,
  idPlatform INTEGER   NOT NULL ,
  idDevCompany INTEGER   NOT NULL ,
  gamename VARCHAR(50)      ,
PRIMARY KEY(idgame, gid)      ,
  FOREIGN KEY(idDevCompany)
    REFERENCES devcompany(idDevCompany),
  FOREIGN KEY(idgametype)
    REFERENCES gametype(idgametype),
  FOREIGN KEY(idPlatform)
    REFERENCES platform(idPlatform));


CREATE INDEX Game_FKIndex1 ON game (idDevCompany);
CREATE INDEX Game_FKIndex3 ON game (idPlatform);
CREATE INDEX game_FKIndex3 ON game (idgametype);


CREATE INDEX IFK_Rel_01 ON game (idDevCompany);
CREATE INDEX IFK_Rel_02 ON game (idgametype);
CREATE INDEX IFK_Rel_03 ON game (idPlatform);


CREATE TABLE member_has_Game (
  mid INTEGER   NOT NULL ,
  idgame INTEGER   NOT NULL;



