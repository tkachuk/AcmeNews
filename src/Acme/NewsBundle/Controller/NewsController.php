<?php

namespace Acme\NewsBundle\Controller;

use Doctrine\ORM\EntityNotFoundException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class NewsController extends Controller
{

    /**
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws EntityNotFoundException
     */
    public function getNewsAction($id)
    {
        return $this->render('AcmeNewsBundle:News:item.html.twig', array(
            'newsItem' => $this->getEntity($id),
            'relatedItems' => $this->getRepository()->getRelatedNewsById($id)
        ));
    }


    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getNewsListAction(Request $request)
    {
        $page = $request->query->get('page', 1);
        $perPage = $request->query->get('per_page', 4   );

        $list = $this->getRepository()->getAllByPage($page, $perPage);

        return $this->render('AcmeNewsBundle:News:list.html.twig', array(
            'newsList' => $list
        ));
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getNewsListXmlAction(Request $request)
    {
        $page = $request->query->get('page', 1);
        $perPage = $request->query->get('per_page', 10);

        $list = $this->getRepository()->getAllByPage($page, $perPage);

        $rootNode = new \SimpleXMLElement( "<?xml version='1.0' encoding='UTF-8' standalone='yes'?><list></list>" );

        foreach ($list as $item) {
            $itemNode = $rootNode->addChild('item');
            $itemNode->addAttribute('id', $item->getId());
            $itemNode->addAttribute('date', $item->getDate()->format('Y-m-d'));
            $itemNode->addChild( 'announce', $item->getAnnounce());
            $itemNode->addChild( 'description', $item->getDescription());
        }

        $response = new Response();
        $response->setContent($rootNode->asXML());
        $response->headers->set('Content-Type', 'xml');
        return $response;
    }

    /**
     * @param $id
     * @return object
     * @throws EntityNotFoundException
     */
    private function getEntity($id)
    {
        $entity = $this->getRepository()->find($id);

        if (!$entity) {
            throw new EntityNotFoundException;
        }

        return $entity;
    }

    /**
     * @return \Doctrine\Common\Persistence\ObjectRepository
     */
    private function getRepository()
    {
        return $this->getDoctrine()->getRepository('AcmeNewsBundle:News');
    }

}
