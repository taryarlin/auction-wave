<?php

function success($data, $message = "success")
{
    return response()->json([
        'result' => 1,
        'message' => $message,
        'data' => $data,
    ]);
}

function fail($message = "fail", $data = [], $target = "")
{
    return response()->json([
        'result' => 0,
        'message' => $message,
        'target' => $target,
        'data' => $data,
    ]);
}

function successMessage($message = "success")
{
    return response()->json([
        'result' => 1,
        'message' => $message,
    ]);
}

function failedMessage($message = "fail")
{
    return response()->json([
        'result' => 0,
        'message' => $message,
    ]);
}
