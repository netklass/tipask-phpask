--2014��2��8������û���ͬ��--
ALTER TABLE `ask_user` ADD `supports` INT( 10 ) NOT NULL DEFAULT '0' COMMENT '��ͬ' AFTER `adopts` ;

--2014��2��10�������ͬ��
CREATE TABLE `ask_answer_support` (
 `sid` char(16) NOT NULL,
 `aid` int(10) NOT NULL,
 `time` int(10) NOT NULL,
 PRIMARY KEY (`sid`,`aid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8
