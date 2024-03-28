<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class EmitScope extends Controller
{
    //
    public function sendDataToNode(Request $request)
    {
      
      try{
        // Lấy giá trị của tham số 'id' từ yêu cầu POST, nếu không có thì sử dụng giá trị mặc định 'default_value'
        $id = $request->input('id', 'default_value');
        $scope = $request->input('scope', 'default_value');

        // // Kiểm tra xem user có tồn tại trong cơ sở dữ liệu hay không
        $user = User::where('id', $id)->first();

        if ($user) {
            // Nếu user tồn tại, cập nhật trường scope lên 1 đơn vị
            $user->scope += $scope;
            $user->save();
            $data = [
              'id' => $user->id,
              'scope' => $user->scope
            ];
        } else {
            User::create([
                'id' => $id,
                'scope' => $scope 
            ]);
            $data = [
              'id' => $id,
              'scope' => $scope
            ];
        }

      return response()->json([
          'message' => 'successfully',
          'response' => $data
      ]);
    } catch (Exception $e) {
      return response()->json(['error' => $e], 500);
  }
    }
}