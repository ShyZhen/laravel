<?php
/**
 * Author huaixiu.zhen
 * http://litblc.com
 * User: litblc
 * Date: 2018/3/20
 * Time: 15:14
 */

namespace App\Http\Controllers\Home;


use App\Model\Comment;

class CommentController
{
    public function getAllComments($imageId)
    {
        $comments = Comment::where('art_id', $imageId)
            ->orderBy('created_at')
            ->get();

        $comm = [];
        foreach ($comments as $key => $value) {
            $comm['id'] = $value->id;
            $comm['user_id'] = $value->user_id;
            $comm['username'] = $this->getUserName($value->user_id);
            $comm['avatar'] = $this->getAvatar($value->user_id);
            $comm['comment'] = $value->comment;
            $comm['created_at'] = $value->created_at;
            $comm['parent'] = $this->getParentComment($value->id);   // 二维数组 所有父级为$value->id的评论
        }
        return $comm;
    }
}