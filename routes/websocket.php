<?php

//use Swoole\Http\Request;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Log;
// use Illuminate\Support\Facades\Cache;
// use Illuminate\Support\Facades\Redis;
use SwooleTW\Http\Websocket\Websocket;
use SwooleTW\Http\Websocket\Facades\Websocket as WebsocketProxy;

$namespace = '\App\Http\Controllers\\';

/*
|--------------------------------------------------------------------------
| Websocket Routes
|--------------------------------------------------------------------------
|
| Here is where you can register websocket events for your application.
|
*/

WebsocketProxy::on('connect', $namespace.'WebsocketController@connect');
WebsocketProxy::on('disconnect', $namespace.'WebsocketController@disconnect');

WebsocketProxy::on('message', $namespace.'WebsocketController@message');

WebsocketProxy::on('command', $namespace.'WebsocketController@handleCommand');
WebsocketProxy::on('commandstatus', $namespace.'WebsocketController@commandStatus');

// WebsocketProxy::on('login', function (WebSocket $websocket, $data) {
//     if ($userId = $websocket->getUserId()) {
//         $user = User::find($userId);
//         // Associate the user with the specified fd connection and save it in Redis
//         Redis::hset('socket_id', $user->id, $websocket->getSender());
//         // Get unread messages
//         $rooms = [];
//         foreach (Count::$ROOMLIST as $id => $name) {
//             // Cycle all rooms
//             $result = Count::where('user_id', $user->id)->where('room_id', $id)->first();
//             if ($result) {
//                 $rooms[$name] = $result->count;
//             } else {
//                 $count = new Count();
//                 $count->user_id = $user->id;
//                 $count->room_id = $id;
//                 $count->count = 0;
//                 $count->save();
//                 $rooms[$name] = 0;
//             }
//         }
//         // Print log
//         Log::info($user->name . 'login successful');
//         // Send a message to the client
//         $websocket->emit('count', $rooms);
//     } else {
//         $websocket->emit('login', 'Log in to enter the chat room');
//     }
// });

// WebsocketProxy::on('message', function (WebSocket $websocket, $data) {
//     if ($userId = $websocket->getUserId()) {
//         $user = User::find($userId);
//         // Get message content
//         $msg = $data['msg'];
//         $img = $data['img'];
//         $roomId = intval($data['roomid']);
//         $time = $data['time'];
//         // Message content or room number cannot be empty
//         if((empty($msg)  && empty($img))|| empty($roomId)) {
//             return;
//         }
//         // Log
//         Log::info($user->name . 'in the room' . $roomId . 'Post message: ' . $msg);
//         // Save messages to the database (except picture messages, because they were saved during the upload process)
//         if (empty($img)) {
//             $message = new Message();
//             $message->user_id = $user->id;
//             $message->room_id = $roomId;
//             $message->msg = $msg;  // Text message
//             $message->img = '';  // Picture message left blank
//             $message->created_at = Carbon::now();
//             $message->save();
//         }
//         // Broadcast messages to all users in the room
//         $room = Count::$ROOMLIST[$roomId];
//         $messageData = [
//             'userid' => $user->email,
//             'username' => $user->name,
//             'src' => $user->avatar,
//             'msg' => $msg,
//             'img' => $img,
//             'roomid' => $roomId,
//             'time' => $time
//         ];
//         $websocket->to($room)->emit('message', $messageData);
//         // Update the number of unread messages in this room for all users
//         $userIds = Redis::hgetall('socket_id');
//         foreach ($userIds as $userId => $socketId) {
//             // Update the number of unread messages for each user and send them to the corresponding online users
//             $result = Count::where('user_id', $userId)->where('room_id', $roomId)->first();
//             if ($result) {
//                 $result->count += 1;
//                 $result->save();
//                 $rooms[$room] = $result->count;
//             } else {
//                 // If a user's unread message count record does not exist, initialize it
//                 $count = new Count();
//                 $count->user_id = $user->id;
//                 $count->room_id = $roomId;
//                 $count->count = 1;
//                 $count->save();
//                 $rooms[$room] = 1;
//             }
//             $websocket->to($socketId)->emit('count', $rooms);
//         }
//     } else {
//         $websocket->emit('login', 'Log in to enter the chat room');
//     }
// });

// function roomout(WebSocket $websocket, $data) {
//     if ($userId = $websocket->getUserId()) {
//         $user = User::find($userId);
//         if (empty($data['roomid'])) {
//             return;
//         }
//         $roomId = $data['roomid'];
//         $room = Count::$ROOMLIST[$roomId];
//         // Update online user information
//         $roomUsersKey = 'online_users_' . $room;
//         $onelineUsers = Cache::get($roomUsersKey);
//         if (!empty($onelineUsers[$user->id])) {
//             unset($onelineUsers[$user->id]);
//             Cache::forever($roomUsersKey, $onelineUsers);
//         }
//         $websocket->to($room)->emit('roomout', $onelineUsers);
//         Log::info($user->name . 'Exit the room: ' . $room);
//         $websocket->leave($room);
//     } else {
//         $websocket->emit('login', 'Log in to enter the chat room');
//     }
// }