<?php

namespace Bruno\AdobeConnectClient\Type;

/**
 * Adobe Connect's types constants to Content
 *
 * @link https://helpx.adobe.com/adobe-connect/webservices/common-xml-elements-attributes.html#type
 *
 */
abstract class Content
{
    /**
     * An archived copy of a live Adobe Connect meeting or presentation.
     */
    const ARCHIVE = 'archive';

    /**
     * A piece of content uploaded as an attachment.
     */
    const ATTACHMENT = 'attachment';

    /**
     * A piece of multimedia content created with Macromedia Authorware from Adobe.
     */
    const AUTHORWARE = 'authorware';

    /**
     * A demo or movie authored in Adobe Captivate.
     */
    const CAPTIVATE = 'captivate';

    /**
     * A curriculum, including courses, presentations, and other content.
     */
    const CURRICULUM = 'curriculum';

    /**
     * An external training that can be added to a curriculum.
     */
    const EXTERNAL_EVENT = 'external-event';

    /**
     * A media file in the FLV file format.
     */
    const FLV = 'flv';

    /**
     * An image, for example, in GIF or JPEG format.
     */
    const IMAGE = 'image';

    /**
     * An Adobe Connect meeting.
     */
    const MEETING = 'meeting';

    /**
     * A presentation.
     */
    const PRESENTATION = 'presentation';

    /**
     * A SWF file.
     */
    const SWF = 'swf';
}
