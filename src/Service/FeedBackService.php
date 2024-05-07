<?php

namespace App\Service;

use App\Dto\FeedBackDto;
use App\Entity\FeedBack;
use App\Repository\FeedBackRepository;
use App\Repository\SettingRepository;
use DateTimeImmutable;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Notifier\Bridge\Telegram\TelegramOptions;
use Symfony\Component\Notifier\ChatterInterface;
use Symfony\Component\Notifier\Message\ChatMessage;

class FeedBackService
{
    private $serializer;

    public function __construct(
        private readonly FeedBackRepository $repository,
        private readonly SettingRepository  $settingRepository,
        private readonly MailerInterface    $mailer,
        private readonly ChatterInterface   $chatter,

    )
    {
    }

    public function create(FeedBackDto $dto)
    {
        $feedBack = new FeedBack();
        $feedBack->setName($dto->name);
        $feedBack->setPhone($dto->phone);
        $feedBack->setCreatedAt(new DateTimeImmutable());

        $this->repository->save($feedBack);
        //$this->sendEmail($feedBack);

        $chatMessage = new ChatMessage('
            Обратная связь № ' . $feedBack->getId() . '
            <pre>' . $feedBack->getName() . '</pre>
            <pre>' . $feedBack->getPhone() . '</pre>
        ');
        $telegramOptions = (new TelegramOptions())
            ->parseMode('html')
        ;
        $chatMessage->options($telegramOptions);
        $this->chatter->send($chatMessage);

        return "Обращение зарегистрировано! №" . $feedBack->getId();
    }

    /**
     * @throws TransportExceptionInterface
     */
    public function sendEmail(FeedBack $feedBack): void
    {
        $email = (new TemplatedEmail())
            ->from('glushok19999@gmail.com')
            ->to('glushok19999@gmail.com');

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
