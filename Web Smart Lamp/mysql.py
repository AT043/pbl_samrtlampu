#!/usr/bin/python
import pymysql

class DbServer:
    def __init__(self, host, user, passwd, database):
        self.host = host
        self.user = user
        self.passwd = passwd
        self.database = database
        self.connection = None
        self.cursor = None

    def connect(self):
        self.connection = pymysql.connect(host=self.host, user=self.user, passwd=self.passwd, database=self.database)
        self.cursor = self.connection.cursor()

    def execute_query(self, query):
        if not self.connection or not self.cursor:
            raise RuntimeError("Connection is not established. Call connect() first.")
        self.cursor.execute(query)
        self.connection.commit()

    def close_connection(self):
        if self.connection:
            self.connection.close()
            print("Connection closed.")
            self.connection = None
            self.cursor = None

koneksi = DbServer("192.168.1.2", "test", "test", "smart_lamp")

try:
    koneksi.connect()

    query = "update users set username = 'admin', password = '$2a$12$MWko9Zzg8JfSEePRs9FSXO/nsbWhRfJG2z1jOf0gnOYexAWMCoV6.' where id = '1';"
    koneksi.execute_query(query)

    print("Update successful!")

except pymysql.Error as e:
    print("Error: {}".format(e))

finally:
    koneksi.close_connection()
