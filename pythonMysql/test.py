# -*- coding: utf-8 -*- 
import MySQLdb
con = MySQLdb.connect(host='localhost',user='root',passwd='123123',db='gwycf')
cursor = con.cursor()

sqlstr = "select * from info order by epost,ecode,zongfen"
#sqlstr = "select distinct epost,ecode from info order by epost"

cursor.execute(sqlstr)
postinfo = cursor.fetchall()
if postinfo:
    for rec in postinfo:
        print rec[0],rec[2],rec[3],rec[7],rec[8]
        #print rec[0],rec[1]

con.commit()
cursor.close()
con.close()
