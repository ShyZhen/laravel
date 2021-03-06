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
use App\Model\User;

class CommentController
{
    /**
     * 得到该图片的所有评论信息
     * Author huaixiu.zhen
     * http://litblc.com
     * @param $imageId
     * @return array
     */
    public function getAllComments($imageId = 1)
    {
        $comments = Comment::where('image_id', $imageId)
            ->whereParentId(0)
            ->orderBy('created_at')
            //分页处理,取出特定几条
            ->get();

        $res = [];
        foreach ($comments as $key => $value) {
            $comm['id'] = $value->id;
            $comm['user_id'] = $value->user_id;
            $comm['username'] = $this->getUserName($value->user_id);
            $comm['avatar'] = $this->getAvatar($value->user_id);
            $comm['comment'] = $value->content;
            $comm['created_at'] = $value->created_at->format('Y-m-d H:i:s');
            $comm['son'] = $this->getSonComment($value->id);   // 多维数组 所有父级为$value->id的评论
            $res[] = $comm;
        }

        //dd($res);
        return view('home.comment')->with('comments', $res);
    }

    /**
     * Author huaixiu.zhen
     * http://litblc.com
     * @param $userId
     * @return string
     */
    private function getUserName($userId)
    {
        $user = User::find($userId);
        if ($user) {
            $userName = $user->name;
        } else {
            $userName = '用户已注销';
        }

        return $userName;
    }

    /**
     * Author huaixiu.zhen
     * http://litblc.com
     * @param $userId
     * @return string
     */
    private function getAvatar($userId)
    {
        $user = User::find($userId);
        if ($user) {
            $avatar = $user->avatar;
        } else {
            $avatar = 'default.jpg';
        }

        return $avatar;
    }

    /**
     * 递归得到所有子评论
     * Author huaixiu.zhen
     * http://litblc.com
     * @param $commentId
     * @return mixed
     */
    private function getSonComment($commentId)
    {
        $comments = Comment::whereParentId($commentId)
            ->orderBy('created_at', 'desc')
            ->get();

        $res = [];
        if ($comments->count() > 0) {
            foreach ($comments as $key => $value) {
                $comm['id'] = $value->id;
                $comm['user_id'] = $value->user_id;
                $comm['username'] = $this->getUserName($value->user_id);
                $comm['avatar'] = $this->getAvatar($value->user_id);
                $comm['comment'] = $value->content;
                $comm['created_at'] = $value->created_at->format('Y-m-d H:i:s');
                $comm['son'] = $this->getSonComment($value->id);
                $res[] = $comm;
            }
        }

        return $res;
    }
}