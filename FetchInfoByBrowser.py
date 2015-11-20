#coding=utf-8
#from xlrd importWopen_workbook
import sys
import xlrd
import time
import MySQLdb
from splinter import Browser
def splinter(url):
    #"""""""""""""""""""""""""MySQL DEF**********************************************
    conn = MySQLdb.connect(host='192.168.1.8',user='root',passwd='123123',db='gwycf')
    cursor = conn.cursor()#create cursor operate db
    #"""""""""""""""""""""""""MySQL DEF**********************************************
    data = xlrd.open_workbook('./chafen.xlsx')
    table = data.sheets()[0]
    nrows = table.nrows 
    ncols = table.ncols
    print nrows
    
    browser = Browser('firefox')
#    browser = Browser('chrome')
    dir(browser)
    browser.visit(url)
    time.sleep(5)
    count = 0
    #<================================================>
    for i in range(nrows):
        #HaoMa = str(table.row_values(i)[1]).split(".")[0]
        name = table.row_values(i)[0]
        HaoMa = table.row_values(i)[1]
#        epost = table.row_values(i)[2]

        browser.find_by_name('TxtName').fill(name)
        browser.find_by_name('TxtHaoMa').fill(HaoMa)
        browser.find_by_id('btnSubmit').click()
	#=================获取页面数据=====================
        epost = browser.find_by_tag('td')[10].value
        ecode = browser.find_by_tag('td')[14].value
        xingce = browser.find_by_tag('td')[16].value
        shenlun = browser.find_by_tag('td')[18].value
        jiafen = browser.find_by_tag('td')[20].value
        zongfen = browser.find_by_tag('td')[22].value
	#=================获取页面数据======================
        query = u"insert into info values('%s','%s','%s','%s','%s','%s','%s','%s',0)" % (name,HaoMa,epost,ecode,xingce,shenlun,jiafen,zongfen)
        print count,query
        cursor.execute(query.encode('utf-8')) #原始数据可以根据gbk运行无错，现在改成utf8
        conn.commit()
        browser.back()
        count = count +1
    cursor.close()
    conn.commit()
    conn.close()

if __name__ == '__main__':
    websize3 ='http://www.gzpta.gov.cn/gwycj/GzCjcx/GzSearch.aspx?examSort=91&examDate=1&examName=2015%u5e74%u8d35%u5dde%u7701%u7edf%u4e00%u9762%u5411%u793e%u4f1a%u516c%u5f00%u62db%u8003%u516c%u52a1%u5458%u8003%u8bd5'
    splinter(websize3)
