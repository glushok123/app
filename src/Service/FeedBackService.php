<?php

namespace App\Service;

use App\Dto\FeedBackDto;
use App\Entity\FeedBack;
use App\Repository\FeedBackRepository;
use App\Repository\SettingRepository;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class FeedBackService
{
    private $serializer;

    public function __construct(
        private readonly FeedBackRepository $repository,
        private readonly SettingRepository  $settingRepository,
        private readonly MailerInterface    $mailer,
    )
    {
    }

    public function create(FeedBackDto $dto)
    {
        $feedBack = new FeedBack();
        $feedBack->setEmail($dto->email);
        $feedBack->setName($dto->name);
        $feedBack->setPhone($dto->phone);
        $feedBack->setMessage($dto->message);
        $feedBack->setBook($dto->book);

        $this->repository->save($feedBack);
        $this->sendEmail($feedBack);

        return $feedBack->getId();
    }

    /**
     * @throws TransportExceptionInterface
     */
    public function sendEmail(FeedBack $feedBack): void
    {
        $email = (new TemplatedEmail())
            ->from('glushok19999@gmail.com')
            ->to($this->settingRepository->findOneBy(['name' => 'sendEmail'])->getValue());

        $email = $email
            ->priority(Email::PRIORITY_HIGH)
            ->subject("Обратная связь с Сайта")
            ->htmlTemplate('notification/feedBack.html.twig')
            ->context([
                'feedback' => $feedBack,
            ]);

        $this->mailer->send($email);
    }
}
