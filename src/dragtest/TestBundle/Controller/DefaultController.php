<?php

namespace dragtest\TestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use tbn\Bundle\JsonAnnotationBundle\Configuration\Json;
use tbn\Component\Serializer\Normalizer\GetSetPrimaryMethodNormalizer;

class DefaultController extends Controller
{
    /**
     * The main view
     *
     * @Route("/")
     * @Template()
     *
     * @return array
     */
    public function indexAction()
    {
        return array();
    }

    /**
     * The main view
     *
     * @Route("/addfriendtogroup")
     * @Json()
     *
     * @return array
     */
    public function addfriendtogroupAction()
    {
        $request = $this->get('request');
        $circleId = $request->request->get('circle');
        $friendId = $request->request->get('friend');

        $circleRepository = $this->getDoctrine()->getRepository('TestBundle:Circle');
        $circle = $circleRepository->find($circleId);
        unset($circleRepository);

        $friendRepository = $this->getDoctrine()->getRepository('TestBundle:Friend');
        $friend = $friendRepository->find($friendId);
        unset($circleRepository);

        $friend->setCircle($circle);

        $em = $this->getDoctrine()->getManager();
        $em->persist($friend);
        $em->flush();

        $data = array();
        $data['circle'] = $circleId;
        $data['friend'] = $friendId;

        return $data;
    }



    /**
     * Load the friends
     *
     * @Route("/loadfriends")
     * @Json()
     *
     * @return array The friends
     */
    public function loadFriendsAction()
    {
        $jsonData = array();
        $jsonData['friends'] = $this->getAllDataFromRepository('TestBundle:Friend');

        return $jsonData;
    }

    /**
     * Load the friends
     *
     * @Route("/loadcircles")
     * @Json()
     *
     * @return array The circles
     */
    public function loadCirclesAction()
    {
        $jsonData = array();
        $jsonData['circles'] = $this->getAllDataFromRepository('TestBundle:Circle');

        return $jsonData;
    }

    /**
     * get the array of normalized entities of a repository
     *
     * @param string $repositoryName The repository name
     *
     * @return array:array
     */
    private function getAllDataFromRepository($repositoryName)
    {
        $normalizer = new GetSetPrimaryMethodNormalizer();
        $normalizedData = array();

        $repository = $this->getDoctrine()->getRepository($repositoryName);
        $data = $repository->findAll();

        foreach ($data as $entity) {
            $normalizedData[] = $normalizer->normalize($entity);
        }

        return $normalizedData;
    }
}
