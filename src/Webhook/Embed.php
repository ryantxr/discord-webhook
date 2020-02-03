<?php namespace Ryantxr\Discord\Webhook;

/**
 *  Discord embed object for webhooks
 *
 *  This is a client to communicate to discord using a webhook
 *
 *  @author yourname
 */
class Embed
{
    /**
     * @var string $url
     */
    private $url;

    /**
     * @var string $title
     */
    private $title;

    /**
     * @var string $type
     */
    private $type = 'rich';

    /**
     * @var string $description
     */
    private $description;

    /**
     * @var int $timestamp
     */
    private $timestamp;

    /**
     * @var int $color
     */
    private $color;

    /**
     * @var EmbedFooter
     */
    private $footer;

    /**
     * @var EmbedImage
     */
    private $image;

    /**
     * @var EmbedThumbnail
     */
    private $thumbnail;

    /**
     * @var EmbedVideo
     */
    private $video;

    /**
     * @var EmbedProvider
     */
    private $provider;

    /**
     * @var EmbedAuthor
     */
    private $author;

    /**
     * @var array
     */
    private $fields;

    /**
     * Constructor.
     *
     * @param string $url
     */
    public function __construct($url = null)
    {
        $this->url = $url;
    }

    public function config(array $args)
    {
        foreach ( $args as $key => $arg ) {
            if ( isset($this->$key) ) {
                $this->$key = $arg;
            }
        }
    }

    public function title($title, $url = null)
    {
        $this->title = $title;
        if ( $url ) {
            $this->url = $url;
        }
        return $this;
    }

    public function description($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * 
     * @param
     * @return
     */
    public function timestamp($timestamp)
    {
        $this->timestamp = $timestamp;
        return $this;
    }

    /**
     * 
     * @param
     * @return
     */
    public function color($color)
    {
        $this->color = is_int($color) ? $color : hexdec($color);
        return $this;
    }

    /**
     * 
     * @param
     * @return
     */
    public function url($url)
    {
        $this->url = $url;
        return $this;
    }

    /**
     * 
     * @param
     * @return
     */
    public function footer($text, $iconUrl = null)
    {
        $this->footer = [
          'text' => $text,
          'icon_url' => $iconUrl,
        ];
        return $this;
    }

    /**
     * Set the image url
     * @param
     * @return
     */
    public function image($url)
    {
        $this->image = [
          'url' => $url,
        ];
        return $this;
    }

    /**
     * Set the thumbnail url
     * @param
     * @return
     */
    public function thumbnail($url)
    {
        $this->thumbnail = [
          'url' => $url,
        ];
        return $this;
    }

    /**
     * 
     * @param
     * @return
     */
    public function author($name, $url = null, $iconUrl = null)
    {
        $this->author = [
          'name' => $name,
          'url' => $url,
          'icon_url' => $iconUrl,
        ];
        return $this;
    }

    /**
     * 
     * @param
     * @return
     */
    public function field($name, $value, $inline = false)
    {
        $this->fields[] = [
          'name' => $name,
          'value' => $value,
          'inline' => boolval($inline),
        ];
        return $this;
    }

    /**
     * Converts the embed object to an array
     *
     * @return array
     */
    public function toArray()
    {
        $arr = [];
        
        $vars = [
            'title'      ,
            'type'       ,
            'description',
            'url'        ,
            'color'      ,
            'footer'     ,
            'image'      ,
            'thumbnail'  ,
            'author'     ,
            'fields'     ,
            'provider'   ,
            'video'      
        ];
        foreach($vars as $var) {
            if ( ! empty($this->$var) ) {
                $arr[$var] = $this->$var;
            }
        }
        return $arr;
    }
}
