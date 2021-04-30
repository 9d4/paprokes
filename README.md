#### How to Run

Configure the `docker-compose.yml` base on you need. You may
change ports or something. For example if you want to run 
this branch and `main` branch simultaneously, you need to change
the ports so the won't collide.

Simply execute 
```
sail -p paprokes-2 up -d
```
to run the container, which
`paprokes-2` is the prefix for docker name.

Make sure you have read [Laravel Sail docs](https://laravel.com/docs/8.x/sail)
to grasp the basic of sail.
