<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmitScope extends Controller
{
    //
    public function sendDataToNode(Request $request)
    {
      return response()->json(['message' => 'Data sent to Node.js successfully', 'response' => $request]);
        // try {// Lấy dữ liệu từ yêu cầu POST
        //   $data = $request->all();
  
        //   // In ra dữ liệu để kiểm tra
        //   dd($data);
        //   return response()->json($data);
        //    // return response()->json(['message' => 'Data sent to Node.js successfully', 'response' => $responseData]);
        // } catch (Exception $e) {
        //   dd($e);
        //     return response()->json(['error' => 'Error sending data to Node.js: ' . $e->getMessage()], 500);
        // }
    }
}