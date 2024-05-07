<?php


namespace App\Controller;

use App\Dto\FeedBackDto;
use App\Dto\RequestDto;
use App\Dto\Util\UploadImageRequestDto;
use App\Dto\Util\UploadImageResponseDto;
use App\Service\BookService;
use App\Service\FeedBackService;
use App\Service\StaticTextService;
use EasyCorp\Bundle\EasyAdminBundle\Contracts\Orm\EntityPaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapQueryString;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
header("Access-Control-Allow-Headers: X-Requested-With");

class HomeController extends AbstractController
{

    const ARTICLE_IMAGE_UPLOAD_PATH = '/images';
    const MOVE_PATH = '/app/public/upload';

    public function __construct(
        private readonly BookService       $bookService,
        private readonly FeedBackService   $feedBackService,
        private readonly StaticTextService $staticTextService,
    )
    {
    }

    #[Route('/', name: 'app_home', methods: ['GET'])]
    public function home(): Response
    {
        return $this->render('index.html.twig', [
            'text' => $this->staticTextService->get('main')
        ]);
    }

    #[Route('/scan', name: 'app_scan', methods: ['GET'])]
    public function scan(): Response
    {
        return $this->render('scan.html.twig', [
            'textScan' => $this->staticTextService->get('scan')
        ]);
    }

    #[Route('/catalog', name: 'app_catalog', methods: ['GET'])]
    public function catalog(PaginatorInterface $paginator, #[MapQueryString] ?RequestDto $dto): Response
    {
        return $this->render('catalog.html.twig', [
            "pagination" => $this->bookService->getCollection($paginator, $dto ?? new RequestDto()),
            "authors" => $this->bookService->getCollectionAuthor($dto ?? new RequestDto()),
            "categoryBooks" => $this->bookService->getCollectionCategory($dto ?? new RequestDto()),
            "dto" => $dto ?? new RequestDto(),
        ]);
    }

    #[Route('/book', name: 'app_book', methods: ['GET'])]
    public function book(#[MapQueryString] RequestDto $dto): Response
    {
        return $this->render('book.html.twig', [
            "book" => $this->bookService->get($dto ?? new RequestDto()),
        ]);
    }

    #[Route('/feedback/create', name: 'app_feedback_create', methods: ['POST'])]
    public function createFeedback(#[MapRequestPayload] FeedBackDto $dto): Response
    {
        return new JsonResponse(['id' => $this->feedBackService->create($dto)]);
    }

    #[Route('/upload-image', name: 'admin_image_upload')]
    public function index(Request $request): Response
    {

        $dto = new \App\Dto\UploadImageRequestDto(
            file: $request->files->get('upload'),
            destination: 'image',
           // host: $this->getParameter('main_host')
        );

        $file = $dto->file;
        $movePath = self::MOVE_PATH;
        $hostPath =  '/upload';
        $name = 'article-' . date('Y-m-d_H-i-s') . '.' . $file->getClientOriginalExtension();
        if ($dto->destination == 'article') {
            $movePath = $movePath . self::ARTICLE_IMAGE_UPLOAD_PATH;
            $hostPath = $hostPath . self::ARTICLE_IMAGE_UPLOAD_PATH;
        }
        $file->move($movePath, $name);

        $newDto =  new \App\Dto\UploadImageResponseDto(
            url: $hostPath . '/' . $name, uploaded: 1, fileName: $name
        );

            return new JsonResponse(
                $newDto->toArray()
            );

    }
}
