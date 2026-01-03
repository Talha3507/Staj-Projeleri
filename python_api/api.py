import tweepy
from time import sleep
from credentials import *
from config import  QUERY, FOLLOW, LIKE, SLEEP_TIME

auth = tweepy.OAuthHandler(consumer_key, consumer_secret)
auth.set_access_token(access_token, access_token_secret)
api = tweepy.API(auth)

print("Tweetleri retweet eden, beğenen ve kullanıcıları takip eden bir Twitter botu.")
print("Bot ayarları")
print("Tweetleri beğen :", LIKE)
print("Kullanıcıları Takip Et :", FOLLOW)

for tweet in tweepy.Cursor(api.search_tweets, q = QUERY).items():
    try:
        print('\nTweet by: @' + tweet.user.screen_name)

        tweet.retweet()
        print('Tweeti yeniden paylaştı')

        if LIKE:
            tweet.favorite()
            print('Tweeti Favorilere ekledim')


        if FOLLOW:
            if not tweet.user.following:
                tweet.user.follow()
                print('Kullanıcıyı Takip Ettim')

        sleep(SLEEP_TIME)

    except tweepy.TweepError as e:
        print(e.reason)

    except StopIteration:
        break