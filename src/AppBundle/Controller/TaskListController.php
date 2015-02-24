<?php namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use AppBundle\Entity\TaskList;

class TaskListController extends Controller
{
    /**
     * @Route("/task/list", name="lists")
     */
    public function indexAction()
    {
        $lists = $this->getDoctrine()
            ->getRepository('AppBundle:TaskList')
            ->findAllOrderedByName();

        return $this->render('AppBundle:TaskList:index.html.twig', ['lists' => $lists]);
    }

    /**
     * @Route("/task/list/new", name="new_list")
     */
    public function newAction(Request $request)
    {
        $taskList = new TaskList();

        $form = $this->createForm('taskList', $taskList);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($taskList);
            $em->flush();

            return $this->redirect($this->generateUrl('lists'));
        }

        return $this->render('AppBundle:TaskList:edit.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @Route("/task/list/edit/{id}", name="edit_list", requirements={"id": "\d+"})
     */
    public function editAction($id, Request $request)
    {
        $taskList = $this->getDoctrine()->getRepository('AppBundle:TaskList')->find($id);

        if (!$taskList) {
            throw $this->createNotFoundException('No task list foun for id '.$id);
        }

        $form = $this->createForm('taskList', $taskList);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirect($this->generateUrl('lists'));
        }

        return $this->render('AppBundle:TaskList:edit.html.twig', ['form' => $form->createView()]);
    }
}
