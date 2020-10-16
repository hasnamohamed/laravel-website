<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\BackEnd\BackEndController;
use App\Http\Requests\Backend\Comments\Store as CommentsStore;
use App\Mail\ReplayContact;
use App\Models\Message;
use Illuminate\Support\Facades\Mail;

class Messages extends BackEndController
{
    public function __construct(Message $model)
    {
        parent::__construct($model);
    }
    public function replay($id, CommentsStore $request)
    {
        $message = $this->model->findOrFail($id);
        Mail::send(new ReplayContact($message, $request->message));
        return redirect()->route('messages.edit', ['id' => $message->id]);
    }
}
