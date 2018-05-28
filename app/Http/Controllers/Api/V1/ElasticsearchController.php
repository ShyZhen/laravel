<?php
/**
 * Created by huaixiu.zhen@gmail.com
 * http://litblc.com
 * User: huaixiu.zhen
 * Date: 2018/5/26
 * Time: 19:33
 */

namespace App\Http\Controllers\Api\V1;

use Elasticsearch\ClientBuilder;

class ElasticsearchController
{
    private static $esClient;

    /**
     * 初始化连接
     */
    public function __construct()
    {
        if (!self::$esClient) {
            self::$esClient = ClientBuilder::create()
                ->setHosts([env('ELASTICSEARCH_HOST_NODE_1')])
                ->build();
        }
    }


    /**
     * 创建一个索引（index,类似于创建一个库）
     * 6.0版本以后一个index只能有一个type
     * Author huaixiu.zhen@gmail.com
     * http://litblc.com
     * @param $index
     * @return array
     */
    public function indexCreate($index)
    {
        $params = [
            'index' => $index,
            'body' => [
                'settings' => [
                    'number_of_shards' => env('NUMBER_OF_SHARDS', 5),      // 分片 默认5
                    'number_of_replicas' => env('NUMBER_OF_REPLICAS', 1)   // 副本、备份 默认1
                ]
            ]
        ];
        $response = self::$esClient->indices()->create($params);

        return $response;
    }


    /**
     * 删除一个索引（index,类似于删除一个库）
     * Author huaixiu.zhen@gmail.com
     * http://litblc.com
     * @param $index
     * @return array
     */
    public function indexDelete($index)
    {
        $params = [
            'index' => $index
        ];
        $response =  self::$esClient->indices()->delete($params);

        return $response;
    }


    /**
     * 更改或增加user索引的映射
     * 在创建完user的index后使用
     * Author huaixiu.zhen
     * http://litblc.com
     * @param $index
     * @param $type
     * @return array
     */
    public function putMappingsForUser($index, $type)
    {
        $params = [
            'index' => $index,
            'type' => $type,
            'body' => [
                $type => [
                    '_source' => [
                        'enabled' => true
                    ],
                    'properties' => [
                        'name' => [                     // name 是需要搜索分词的字段
                            'type' => 'text',
                            'analyzer' => 'ik_smart',
                            'search_analyzer' => 'ik_smart',
                            'search_quote_analyzer' => 'ik_smart'
                        ]
                    ]
                ]
            ]
        ];
        $response = self::$esClient->indices()->putMapping($params);

        return $response;
    }

    /**
     * 更改或增加 文章post 索引的映射
     * 在创建完post的index后使用
     * Author huaixiu.zhen
     * http://litblc.com
     * @param $index
     * @param $type
     * @return array
     */
    public function putMappingsForPost($index, $type)
    {
        $params = [
            'index' => $index,
            'type' => $type,
            'body' => [
                $type => [
                    '_source' => [
                        'enabled' => true
                    ],
                    'properties' => [
                        'title' => [
                            'type' => 'text',
                            'analyzer' => 'ik_smart',
                            'search_analyzer' => 'ik_smart',
                            'search_quote_analyzer' => 'ik_smart'
                        ],
                        'content' => [
                            'type' => 'text',
                            'analyzer' => 'ik_smart',
                            'search_analyzer' => 'ik_smart',
                            'search_quote_analyzer' => 'ik_smart'
                        ],
                    ]
                ]
            ]
        ];
        $response = self::$esClient->indices()->putMapping($params);

        return $response;
    }


    /**
     * 创建一条数据（索引一个文档）
     * Author huaixiu.zhen@gmail.com
     * http://litblc.com
     * @param $index string
     * @param $type string
     * @param $id int
     * @param $body array('key' => 'val')
     * @return array
     */
    public function createDoc($index, $type, $id, $body)
    {
        $params = [
            'index' => $index,
            'type' => $type,
            'id' => $id,
            'body' => $body,

        ];
        $response = self::$esClient->index($params);

        return $response;
    }


    /**
     * 获取一个文档（对应上面createDoc）
     * Author huaixiu.zhen@gmail.com
     * http://litblc.com
     * @param $index string
     * @param $type string
     * @param $id int
     * @return array
     */
    public function getDoc($index, $type, $id)
    {
        $params = [
            'index' => $index,
            'type' => $type,
            'id' => $id
        ];
        $response = self::$esClient->get($params);

        return $response;
    }


    /**
     * 搜索文档 doc
     * Author huaixiu.zhen@gmail.com
     * http://litblc.com
     * @param $index string
     * @param $type string
     * @param $query string
     * @return array
     */
    public function search($index, $type, $query)
    {
        $params = [
            'index' => $index,
            'type' => $type,
            'body' => [
                'query' => [
// 单字段
//                    'match' => [
//                        'key1' => $query
//                    ]

// 多字段
                    'multi_match' => [
                        'query' => $query,
                        "type" => "best_fields",
                        'operator' => 'or',
                        'fields' => ['title', 'content']  // TODO 根据数据表字段，准确说是存入es的字段进行修改
                    ]
                ]
            ]
        ];
        $response = self::$esClient->search($params);

        return $response['hits'];
    }


    /**
     * 删除一条记录（文档） doc
     * Author huaixiu.zhen@gmail.com
     * http://litblc.com
     * @param $index
     * @param $type
     * @param $id
     * @return array
     */
    public function delete($index, $type, $id)
    {
        $params = [
            'index' => $index,
            'type' => $type,
            'id' => $id
        ];
        $response = self::$esClient->delete($params);

        return $response;
    }
}