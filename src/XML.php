<?php
/**
 * @license MIT
 */

namespace PressKit;

/**
 * Parses XML files for press_kit and returns the data in a array
 *
 * @todo Refactor using collections
 */
class XML
{
    private $file;
    private $data = [];

    /**
     * XML constructor.
     *
     * @param string $filename The path to the xml file to parse
     */
    public function __construct($filename)
    {
        libxml_use_internal_errors(true);
        $file = simplexml_load_file($filename);

        if (sizeof(libxml_get_errors()) === 0) {
            $this->file = $file;

            $this->parseTitle();
            $this->parseWebsite();
            $this->parseBasedIn();
            $this->parseFoundingDate();
            $this->parsePressContact();
            $this->parseSocialLinks();
            $this->parseAddress();
            $this->parsePhoneNumber();
            $this->parseDescription();
            $this->parseHistory();
            $this->parseTrailers();
            $this->parseAwards();
            $this->parseQuotes();
            $this->parseAdditionalLinks();
            $this->parseCredits();
            $this->parseContacts();
            $this->parseAnalytics();
        }
    }

    /**
     * Get the parsed data
     *
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Get the title from the XML file
     */
    private function parseTitle()
    {
        if (isset($this->file->title)) {
            $this->data['title'] = (string) $this->file->title;
        }
    }

    /**
     * Get the website from the XML file
     */
    private function parseWebsite()
    {
        if (isset($this->file->website)) {
            $this->data['website'] = (string) $this->file->website;
        }
    }

    /**
     * Get the based-in location from the XML file
     */
    private function parseBasedIn()
    {
        if (isset($this->file->{'based-in'})) {
            $this->data['basedIn'] = (string) $this->file->{'based-in'};
        }
    }

    /**
     * Get the founding date from the XML file
     */
    private function parseFoundingDate()
    {
        if (isset($this->file->{'founding-date'})) {
            $this->data['foundingDate'] = (string) $this->file->{'founding-date'};
        }
    }

    /**
     * Get the press contact from the XML file
     */
    private function parsePressContact()
    {
        if (isset($this->file->{'press-contact'})) {
            $this->data['pressContact'] = (string) $this->file->{'press-contact'};
        }
    }

    /**
     * Get the social links from the XML file
     */
    private function parseSocialLinks()
    {
        if (isset($this->file->socials)) {
            $links = [];

            foreach ($this->file->socials->social as $social) {
                $links[] = [
                    'name' => (string) $social->name,
                    'url' => (string) $social->link,
                ];
            }

            $this->data['socialLinks'] = $links;
        }
    }

    /**
     * Get the address from the XML file
     */
    private function parseAddress()
    {
        if (isset($this->file->address)) {
            $address = [];

            foreach ($this->file->address->line as $line) {
                $address[] = (string) $line;
            }

            $this->data['address'] = $address;
        }
    }

    /**
     * Get the phone number from the XML file
     */
    private function parsePhoneNumber()
    {
        if (isset($this->file->phone)) {
            $this->data['phoneNumber'] = (string) $this->file->phone;
        }
    }

    /**
     * Get the description from the XML file
     */
    private function parseDescription()
    {
        if (isset($this->file->description)) {
            $this->data['description'] = (string) $this->file->description;
        }
    }

    /**
     * Get the history from the XML file
     */
    private function parseHistory()
    {
        if (isset($this->file->histories)) {
            $history = [];

            foreach ($this->file->histories->history as $story) {
                $history[] = [
                    'header' => (string) $story->header,
                    'body' => (string) $story->text,
                ];
            }

            $this->data['history'] = $history;
        }
    }

    /**
     * Get the trailers from the XML file
     */
    private function parseTrailers()
    {
        if (isset($this->file->trailers)) {
            $trailers = [];

            foreach ($this->file->trailers->trailer as $trailer) {
                $t = [
                    'name' => (string) $trailer->name,
                    'videos' => [],
                ];

                if (isset($trailer->youtube)) {
                    $t['videos'][] = [
                        'service' => 'youtube',
                        'id' => (string) $trailer->youtube,
                    ];
                }

                if (isset($trailer->vimeo)) {
                    $t['videos'][] = [
                        'service' => 'vimeo',
                        'id' => (string) $trailer->vimeo,
                    ];
                }

                if (isset($trailer->mp4)) {
                    $t['videos'][] = [
                        'service' => 'file',
                        'id' => (string) $trailer->mp4,
                    ];
                }

                if (isset($trailer->mov)) {
                    $t['videos'][] = [
                        'service' => 'file',
                        'id' => (string) $trailer->mov,
                    ];
                }

                $trailers[] = $t;
            }

            $this->data['trailers'] = $trailers;
        }
    }

    /**
     * Get the awards from the XML file
     */
    private function parseAwards()
    {
        if (isset($this->file->awards)) {
            $awards = [];

            foreach ($this->file->awards->award as $award) {
                $awards[] = [
                    'award' => (string) $award->description,
                    'about' => (string) $award->info,
                ];
            }

            $this->data['awards'] = $awards;
        }
    }

    /**
     * Get the quotes from the XML file
     */
    private function parseQuotes()
    {
        if (isset($this->file->quotes)) {
            $quotes = [];

            foreach ($this->file->quotes->quote as $quote) {
                $quotes[] = [
                    'description' => (string) $quote->description,
                    'author' => (string) $quote->name,
                    'website' => [
                        'name' => (string) $quote->website,
                        'url' => (string) $quote->link,
                    ],
                ];
            }

            $this->data['quotes'] = $quotes;
        }
    }

    /**
     * Get the additional links from the XML file
     */
    private function parseAdditionalLinks()
    {
        if (isset($this->file->additionals)) {
            $additionalLinks = [];

            foreach ($this->file->additionals->additional as $additionalLink) {
                $additionalLinks[] = [
                    'title' => (string) $additionalLink->title,
                    'description' => (string) $additionalLink->description,
                    'url' => (string) $additionalLink->link,
                ];
            }

            $this->data['additionalLinks'] = $additionalLinks;
        }
    }

    /**
     * Get the credits from the XML file
     */
    private function parseCredits()
    {
        if (isset($this->file->credits)) {
            $credits = [];

            foreach ($this->file->credits->credit as $credit) {
                $c = [
                  'name' => (string) $credit->person,
                  'role' => (string) $credit->role,
                ];

                if (isset($credit->website)) {
                    $c['url'] = (string) $credit->website;
                }

                $credits[] = $c;
            }

            $this->data['credits'] = $credits;
        }
    }

    /**
     * Get the contacts from the XML file
     */
    private function parseContacts()
    {
        if (isset($this->file->contacts)) {
            $contacts = [];

            foreach ($this->file->contacts->contact as $contact) {
                $c = [
                    'title' => (string) $contact->name,
                ];

                if (isset($contact->link)) {
                    $c['url'] = (string) $contact->link;
                }

                if (isset($contact->mail)) {
                    $c['url'] = 'mailto:'.(string) $contact->mail;
                }

                $contacts[] = $c;
            }

            $this->data['contacts'] = $contacts;
        }
    }

    /**
     * Get the analytics tracking id from the XML file
     */
    private function parseAnalytics()
    {
        if (isset($this->file->analytics)) {
            $this->data['analytics'] = [
                'id' => (string) $this->file->analytics,
                'provider' => 'google-analytics',
            ];
        }
    }
}
