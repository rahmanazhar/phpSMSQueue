# About this application

Simple PHP Application that offers queueing of SMS Messages.

# Usage API

## GET Messages

HTTP API to get all SMS messages in the queue in JSON format

### Method POST
```
{url}/queue/getmessages
```

## Insert an SMS Message

 HTTP API to insert an SMS Message in the queue

### Method POST

```
#Parameter
{
    'id' => $id,
    'messages' => $messages,
}
#url
{url}/queue/insert
```

## Consume an SMS Message from the queue

HTTP API to consume an SMS Message from the queue and returns it in JSON format (FIFO)

### Method POST
```
{url}/queue/call
```

## Get the total number of SMS Message from the queue

HTTP API to get the total number of messages in the queue

### Method POST
```
{url}/queue/countmessages
```


## Run This App 

Run this app using Docker

1. Build the docker container
```
docker-compose build app
```

2. Running the docker
```
docker-compose up -d
```

3. Now go to your browser and access your server’s domain name or IP address on port 8000:

http://server_domain_or_IP:8000
