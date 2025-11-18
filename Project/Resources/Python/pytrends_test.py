from pytrends.request import TrendReq

pytrends = TrendReq(hl="en-US", tz=360)

kw = ["Philadelphia Eagles"]
pytrends.build_payload(kw, timeframe="today 12-m")

data = pytrends.interest_over_time()
print(data)
