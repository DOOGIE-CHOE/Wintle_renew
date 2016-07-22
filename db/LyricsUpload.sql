CREATE DEFINER=`root`@`localhost` PROCEDURE `UploadLyrics`(
in _email_address varchar(20),
in _contents_id varchar(30),
in _title varchar(30),
in _contents varchar(1000),
in _tags varchar(300),
out _result int)
BEGIN
	declare result int default 0;
	declare err int default 0;
    declare loopcount int default 0;
    declare _hashtag varchar(255);
    
	declare continue handler for SQLEXCEPTION set err = -1;

	start transaction;

	insert into mylyrics(email_address, contents_id) values(_email_address, _contents_id);

	insert into lyrics(contents_id, title, contents) values(_contents_id, _title, _contents);
	
    insert into lyricslikes(contents_id) values(_contents_id);

do_this:
  LOOP
  
	set loopcount = loopcount + 1;
    set _hashtag = SPLIT_STR(_tags,',',loopcount);

    if _hashtag = ' ' then
    leave do_this;
	end if;
    
	insert into lyricshash(contents_id, hashtag) values (_contents_id, _hashtag);

  END LOOP do_this;

if err<0 then
    set result = -1;
	rollback;
else
	commit;
end if;

END