import mysql.connector, time
from datetime import datetime

class connection(object):

    def __init__(self):
        self.db = mysql.connector.connect(
            host="localhost",
            user="root",
            passwd="",
            database="visitor"
        )
        self.cur = self.db.cursor()

    def selectTable(self,table,field="*",where=""):
        if where != "":
            table = table+" WHERE "+where
        self.cur.execute("SELECT "+field+" FROM "+table)
        return cur.fetchall()

    def getVisitorCard(self,cardUID):
        self.cur.execute("SELECT * FROM visitor_cards WHERE card_uid='"+cardUID+"'")
        return self.cur.fetchone()

    def insertVisitorCard(self,cardUID):
        cek = self.getVisitorCard(cardUID)
        if cek is not None:
            return cek
        if cardUID is None:
            return None
        ts = time.time()
        timestamp = datetime.fromtimestamp(ts).strftime('%Y-%m-%d %H:%M:%S')
        sql = "INSERT INTO visitor_cards (card_uid,created_at) VALUES ('"+cardUID+"','"+timestamp+"')"
        self.cur.execute(sql)
        self.db.commit()
        return self.cur.lastrowid

    def getVisitorAllowedAreaByCard(self,cardId):
        self.cur.execute("SELECT * FROM `visitation_allowed_areas` LEFT JOIN (visitations,visitor_cards) on visitation_allowed_areas.visitation_id = visitations.id AND visitations.card_id = visitor_cards.id WHERE visitor_cards.card_uid = '"+cardId+"'")
        return self.cur.fetchall()

    def getAllowedAreas(self,visitionId):
        self.cur.execute("SELECT * FROM visitation_allowed_areas WHERE card_uid='"+visitation_id+"'")
        return cur.fetchall()

    def isAllowedArea(self,areaId,cardId):
        self.cur.execute("SELECT `visitations`.`id`,`devices`.`id` FROM `visitation_allowed_areas` LEFT JOIN (visitations,visitor_cards,devices) on visitation_allowed_areas.visitation_id = visitations.id AND visitations.card_id = visitor_cards.id WHERE year(visitations.tanggal) = year(now()) AND month(visitations.tanggal) = month(now()) AND day(visitations.tanggal) = day(now()) AND visitor_cards.card_uid = '"+cardId+"' AND visitation_allowed_areas.area_id = '"+areaId+"'")
        data = self.cur.fetchone()
        if data != None:
            return data
    
        return None

    def insertVisitationActivityLogs(self,areaId,cardId):
        data = self.isAllowedArea(areaId,cardId)
        if data == None:
            return False
        ts = time.time()
        timestamp = datetime.fromtimestamp(ts).strftime('%Y-%m-%d %H:%M:%S')
        sql = "INSERT INTO visitation_activity_logs (visitation_id,area_id,device_id,timestamp,created_at) VALUES ('"+str(data[0])+"','"+areaId+"','"+str(data[1])+"','"+timestamp+"','"+timestamp+"')"
        self.cur.execute(sql)
        self.db.commit()
        return {'id_log':self.cur.lastrowid,'cardId':cardId}

if __name__ == '__main__':
    c = connection()
    res = c.insertVisitorCard('coba')
    print(res)
