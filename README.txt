程序的工作流程为
1 ./FetchInfoByBrowser.py 从包含有公务员原始报名数据EXCEL中，逐条取出姓名和考号,
  然后登陆公务员查分网，提交查询，得到返回后将页面上的总分等信息扣下来存入MySQL
2 然后用rank.py对MySQL中的数据进行排名处理
3 php作为表现，MySQL对接

