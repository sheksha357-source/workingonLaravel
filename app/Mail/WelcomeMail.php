<?php
namespace App\Mail;

use App\Models\User;
use BaconQrCode\Renderer\Image\SvgImageBackEnd;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Writer;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WelcomeMail extends Mailable
{
    use SerializesModels;

    public function __construct(public User $user) {}

    public function build()
    {
        $userDetails = [
            'id' => $this->user->id,
            'name' => $this->user->name,
            'email' => 'psvali000@gmail.com', // override email for testing
            'date_of_birth' => optional($this->user->date_of_birth)->format('Y-m-d') ?? 'N/A',
            'created_at' => optional($this->user->created_at)->format('Y-m-d H:i:s') ?? 'N/A',
        ];

        $qrCodeSvg = $this->generateQrCodeSvg($userDetails);
        $pdf = Pdf::loadView('pdfs.user-details', [
            'user' => $this->user,
            'userDetails' => $userDetails,
            'qrCodeSvg' => $qrCodeSvg,
        ])->setPaper('a4');

        return $this->subject('Welcome to Hallimart!')
                    ->view('emails.welcome', [
                        'user' => $this->user,
                        'userDetails' => $userDetails,
                    ])
                    ->attachData(
                        $pdf->output(),
                        'user-details-' . $this->user->id . '.pdf',
                        ['mime' => 'application/pdf']
                    )
                    ->attachData(
                        $qrCodeSvg,
                        'user-qr-' . $this->user->id . '.svg',
                        ['mime' => 'image/svg+xml']
                    );
    }   

    protected function generateQrCodeSvg(array $userDetails): string
    {
        $renderer = new ImageRenderer(
            new RendererStyle(220),
            new SvgImageBackEnd()
        );

        return (new Writer($renderer))->writeString(
            json_encode($userDetails, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES)
        );
    }
}
