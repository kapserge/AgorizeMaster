<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Entity\User;
use App\Entity\Machine;
use App\Form\MachineType;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\MachineRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
//use Symfony\Component\Routing\Annotation\Route;

class MachineController extends Controller
{
    /**
     * @Route("/machine", name="machine")
     */
    public function index()
    {
        return $this->render('machine/categorie.html.twig');
    }


    /**
     * @Route("/CreeMachine/{byFirstname}", name="cree_machine")
     *@ParamConverter("user", options={"mapping"={"byFirstname"="firstname"}})
     */
     public function indexMachine(Request $request, User $user , MachineRepository $MachineRepository)
    {
    
    $machine = new Machine();
    //$user = $this->getUser()->getId();
    //printf($user);
    //exit;
    //$machine  = $userRepository->findAll();
    $form = $this->createForm(MachineType::class, $machine);
    $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
            		//$machine->setUser($user);
                    $entityManager = $this->getDoctrine()->getManager();
                    $machine->setUser($user);
                    $entityManager->persist($machine);

                    $entityManager->flush();
               }
    return $this->render('machine/registerMachine.html.twig', array('form' => $form->createView(), ));
        }
}
