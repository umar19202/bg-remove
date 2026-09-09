<?php

namespace App\Http\Controllers;

use App\Models\ToolUsage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ToolUsageController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tool_name' => 'required|string|max:100',
            'original_filename' => 'nullable|string|max:255',
            'file_size' => 'nullable|integer',
            'success' => 'boolean',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $data = $validator->validated();
        $data['ip_address'] = $request->ip();
        $data['user_agent'] = $request->userAgent();

        if ($request->user()) {
            $data['user_id'] = $request->user()->id;
        }

        ToolUsage::create($data);

        return response()->json(['message' => 'Usage logged']);
    }
}
