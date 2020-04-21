<?php

namespace App\Controller;

use App\Entity\Transaction;
use App\Form\TransactionType;
use App\Repository\TransactionRepository;
use App\Service\RestAPI;
use Predis\Client;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/transaction", name="transaction_")
 */
class TransactionController extends AbstractController
{
    private $cache;

    public function __construct(Client $cache)
    {
        $this->cache = $cache;
    }

    /**
     * @Route("/", name="index", methods={"GET"})
     */
    public function index(): Response
    {
        return $this->render('transaction/index.html.twig');
    }

    /**
     * @Route("/list", name="list", methods={"GET"})
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function list(): JsonResponse
    {

        $query = $this->getDoctrine()->getManager()
            ->createQuery(
                'select t from App:Transaction t where t.state = 1'
            );
       /* $query->useResultCache(true);
        $query->setResultCacheLifetime(300); //300sec = 5 mins*/
        $transactions = $query->getResult();

        $i=1;
        $result = [];
        foreach($transactions as $t){
            $id = "<a href='".$this->generateUrl('transaction_show', ['id'=>$t->getId()])."'>$i</a>";
            $edit = "<a href='".$this->generateUrl('transaction_edit', ['id' => $t->getId()])."'  class='btn btn-info'><i class='fa fa-pencil-square-o' aria-hidden='true'></i>edit</a>";
            $result[] = [
                'id' => $id,
                'tmethod' => $t->getMethod(),
                'ttype' => $t->getTrType(),
                'bamount' => $t->getBamount(),
                'bcurr' => $t->getBcurr(),
                'tamount' => $t->getTamount(),
                'tcurr' => $t->getTcurr(),
                'xrate' => $t->getXrate(),
                'actions' => $edit,
            ];
            $i++;
        }

        return $this->json($result);
    }

    /**
     * @Route("/getrate/{base}/{target}", name="get_rate", methods={"POST"})
     *
     * @param RestAPI $client
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function getRate(RestAPI $client, String $base, String $target){

        $url = 'https://api.exchangeratesapi.io/latest';
        $options = [
            'base' => $base,
        ];

        $id = md5($base);

        // We check if this this request has already been process
        if(!$rp = unserialize($this->cache->get($id))){
            $rp = $client->getAPI($url, 'GET', $options);
            $this->cache->set($id, serialize($rp), 'ex', 300);
        }

        return $this->json( $rp['rates'][$target] );
    }

    /**
     * @Route("/new", name="new", methods={"GET","POST"})
     */
    public function new(Request $request, RestAPI $client): Response
    {
        $transaction = new Transaction();
        $form = $this->createForm(TransactionType::class, $transaction);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $transaction->setTrTmp(time());
            $transaction->setIp($client->getUserIpAddr());

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($transaction);
            $entityManager->flush();

            return $this->redirectToRoute('transaction_index');
        }

        return $this->render('transaction/new.html.twig', [
            'transaction' => $transaction,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="show", methods={"GET"})
     */
    public function show(Transaction $transaction): Response
    {
        return $this->render('transaction/show.html.twig', [
            'transaction' => $transaction,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Transaction $transaction): Response
    {
        $form = $this->createForm(TransactionType::class, $transaction);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('transaction_index');
        }

        return $this->render('transaction/edit.html.twig', [
            'transaction' => $transaction,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="delete", methods={"DELETE"})
     */
    public function delete(Request $request, Transaction $transaction): Response
    {
        if ($this->isCsrfTokenValid('delete'.$transaction->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($transaction);
            $entityManager->flush();
        }

        return $this->redirectToRoute('transaction_index');
    }
}
