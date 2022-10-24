<?php namespace Ryantxr\Discord\Webhook;

/**
 *  Discord embed object for webhooks
 *
 *  This is a client to communicate to discord using a webhook
 *
 *  @author Ryan Teixeira
 */

class Embed
{
    /**
     * @var string $url
     */
    protected $url;

    /**
     * @var string $title
     */
    protected $title;

    /**
     * @var string $type
     */
    protected $type = 'rich';

    /**
     * @var string $description
     */
    protected $description;

    /**
     * @var int $timestamp
     */
    protected $timestamp;

    /**
     * @var int $color
     */
    protected $color;

    protected $footer;

    protected $image;

    protected $thumbnail;

    protected $video;

    protected $provider;

    protected $author;

    /**
     * @var array
     */
    protected $fields;

    /**
     * Constructor.
     *
     * @param string $url
     */
    public function __construct($url=null)
    {
        $this->url = $url;
    }

    /**
     * Set configuration values.
     * 
     * @param array $args Key/value config values.
     */
    public function config(array $args)
    {
        foreach ( $args as $key => $arg ) {
            if ( isset($this->$key) ) {
                $this->$key = $arg;
            }
        }
    }

    /**
     * Set embed title.
     * 
     * @param string $title title of the embed
     * @param string $url An optional url
     * 
     * @return Embed
     */
    public function title($title, $url=null)
    {
        $this->title = $title;
        if ( $url ) {
            $this->url = $url;
        }
        return $this;
    }

    /**
     * Set description
     * 
     * @param string $description A description
     * @return Embed
     */
    public function description($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * Set timestamp
     * 
     * @param int $timestamp A timestamp
     * @return Embed
     */
    public function timestamp($timestamp)
    {
        $this->timestamp = $timestamp;
        return $this;
    }

    /**
     * Set the color.
     * 
     * @param int|string $color The color as an int or hexadecimal
     * @return Embed
     */
    public function color($color)
    {
        $this->color = is_int($color) ? $color : hexdec($color);
        return $this;
    }

    /**
     * Set the embed URL
     * 
     * @param $url Author's url
     * 
     * @return Embed
     */
    public function url($url)
    {
        $this->url = $url;
        return $this;
    }

    /**
     * Set the embed footer.
     * 
     * @param string $text Footer text.
     * @param string $iconUrl Author's icon
     * 
     * @return Embed
     */
    public function footer($text, $iconUrl=null)
    {
        $this->footer = [
          'text' => $text,
          'icon_url' => $iconUrl,
        ];
        return $this;
    }

    /**
     * Set the image url
     * @param $url Author's url
     * @return Embed
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
     * @param $url Author's url
     * @return Embed
     */
    public function thumbnail($url)
    {
        $this->thumbnail = [
          'url' => $url,
        ];
        return $this;
    }

    /**
     * Set the embed author.
     * 
     * @param string $name Author's name 
     * @param string $url Author's url
     * @param string $iconUrl Author's icon
     * 
     * @return Embed
     */
    public function author($name, $url=null, $iconUrl=null)
    {
        $this->author = [
          'name' => $name,
          'url' => $url,
          'icon_url' => $iconUrl,
        ];
        return $this;
    }

    /**
     * Set the value of a field.
     * 
     * @param string $name Name of the field.
     * @param string $value Value of the field.
     * @param bool $inline Is this inline or not.
     * 
     * @return Embed
     */
    public function field($name, $value, $inline=false)
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
        foreach ( $vars as $var ) {
            if ( ! empty($this->$var) ) {
                $arr[$var] = $this->$var;
            }
        }
        return $arr;
    }
}
