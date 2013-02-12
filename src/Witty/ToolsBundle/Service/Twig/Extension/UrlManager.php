<?php

namespace Witty\ToolsBundle\Service\Twig\Extension;


class UrlManager extends \Twig_Extension
{
	/*
	* L'url du site
	*/
	protected $urlSite;
	
	/*
	* Le endpoint AmazonS3 où les médias sont stockés
	*/
	protected $endpointS3;
	

	public function getName()
    {
        return 'UrlManager';
    }

	public function __construct($urlSite, $endpointS3)
	{
		$this->urlSite = $urlSite;
		$this->endpointS3 = $endpointS3;
	}

    public function getFunctions()
    {
        return array(
            'url_asset' => new \Twig_Function_Method($this, 'url_asset') 
        );
    }


    /**
     * Renvoie l'url d'un contenu externe
     * 
     * @param string $name
     */
    public function url_asset($type, $id, $filename = "")
    {
		switch ($type)
		{
			case 'project':
				$url = $this->endpointS3.'project/'.$id.'/'.$filename;
				break;
				
			case 'project_description':
				$url = $this->endpointS3.'project/'.$id.'/description/'.$filename;
				break;
				
			case 'avatar':
				$folder = 'user/'.$id.'/avatar/';
				$url = $this->endpointS3.$folder.$filename;
				break;
				
			case 'acheter_jeu':
				$url = $this->endpointS3.'project/'.$id.'/distribution/'.$filename;
				break;
				
			case 'contenu':
				$url = $this->endpointS3.'content/'.$filename;
				break;
		}

        return $url;
    }

}