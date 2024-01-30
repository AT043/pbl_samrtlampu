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

connection = pymysql.connect(host="192.168.1.2", user="test", passwd="test", database="smart lamp")
#connection = pymysql.connect(host=koneksi.host, user=koneksi.user, passwd=koneksi.passwd, database=koneksi.database)
cursor = connection.cursor()
#query = "use ujicoba;" 
query = " update akun_admin set username = 'admin', password = 'konto' where id = '12340';"
#query = "update admin_account set username = 'admin', password = '$2y$10$7upvEHlA.BVkUeEVrpNnZOxaBNf3ZHhZSt9LkDh4Lry84eh/BTDSO' where id_admin = '1';"
#query = "delete from 'admin_account' where 'admin_account'.'id_admin' = 2;"
cursor.execute(query)
rows = cursor.fetchall()
for row in rows:
    print(row)
    
connection.commit()
connection.close()
