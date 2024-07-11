Build rest api -> Probably use [laravel-api](https://github.com/Froiden/laravel-rest-api)

URL

Generate .ical files when implementing the calendar module -> [iCal Generator](https://github.com/markuspoerschke/iCal)https://github.com/markuspoerschke/iCal





## Video Chat

### Calls
    -> caller_id
    -> type (Video, Audio)
    -> receiver_id
    -> sec_key
    -> call_url
    -> status (answered, missed)

    If answered: 
        Link camera to camera
    else:
        add to missed calls of the receiver

- Video call
    ->Calls::where('type', video)


