#!/usr/bin/python
import pymysql

#class dbserver:
#  def __init__(self, host, user, passwd, database):
#    self.host = host
#    self.user = user
#    self.passwd = passwd
#    self.database = database

#class dbserver:
 #def__init__(self, host, user, passwd, database):
  #self.host = host
  #self.user = user
  #self.passwd = passwd
  #self.database = database

#koneksi = dbserver("192.168.1.2", "test", "test", "smart lamp")

connection = pymysql.connect(host="localhost", user="root", password="", database="smart_lamp")
#connection = pymysql.connect(host=koneksi.host, user=koneksi.user, passwd=koneksi.passwd, database=koneksi.database)
cursor = connection.cursor()
#query = "use ujicoba;" 
query = " update users set username = 'admine1', password = 'AndiYG' where id = '1';"
#query = "update admin_account set username = 'admin', password = '$2y$10$7upvEHlA.BVkUeEVrpNnZOxaBNf3ZHhZSt9LkDh4Lry84eh/BTDSO' where id_admin = '1';"
#query = "delete from 'admin_account' where 'admin_account'.'id_admin' = 2;"
cursor.execute(query)
rows = cursor.fetchall()
for row in rows:
    print(row)
    
connection.commit()
connection.close()
