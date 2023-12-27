<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Rest\Routes\V2;

use Twilio\Options;
use Twilio\Values;

abstract class SipDomainOptions {
    /**
     * @param string $voiceRegion The voice_region
     * @param string $friendlyName The friendly_name
     * @return CreateSipDomainOptions Options builder
     */
    public static function create(string $voiceRegion = Values::NONE, string $friendlyName = Values::NONE): CreateSipDomainOptions {
        return new CreateSipDomainOptions($voiceRegion, $friendlyName);
    }

    /**
     * @param string $voiceRegion The voice_region
     * @param string $friendlyName The friendly_name
     * @return UpdateSipDomainOptions Options builder
     */
    public static function update(string $voiceRegion = Values::NONE, string $friendlyName = Values::NONE): UpdateSipDomainOptions {
        return new UpdateSipDomainOptions($voiceRegion, $friendlyName);
    }
}

class CreateSipDomainOptions extends Options {
    /**
     * @param string $voiceRegion The voice_region
     * @param string $friendlyName The friendly_name
     */
    public function __construct(string $voiceRegion = Values::NONE, string $friendlyName = Values::NONE) {
        $this->options['voiceRegion'] = $voiceRegion;
        $this->options['friendlyName'] = $friendlyName;
    }

    /**
     * The voice_region
     *
     * @param string $voiceRegion The voice_region
     * @return $this Fluent Builder
     */
    public function setVoiceRegion(string $voiceRegion): self {
        $this->options['voiceRegion'] = $voiceRegion;
        return $this;
    }

    /**
     * The friendly_name
     *
     * @param string $friendlyName The friendly_name
     * @return $this Fluent Builder
     */
    public function setFriendlyName(string $friendlyName): self {
        $this->options['friendlyName'] = $friendlyName;
        return $this;
    }

    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString(): string {
        $options = \http_build_query(Values::of($this->options), '', ' ');
        return '[Twilio.Routes.V2.CreateSipDomainOptions ' . $options . ']';
    }
}

class UpdateSipDomainOptions extends Options {
    /**
     * @param string $voiceRegion The voice_region
     * @param string $friendlyName The friendly_name
     */
    public function __construct(string $voiceRegion = Values::NONE, string $friendlyName = Values::NONE) {
        $this->options['voiceRegion'] = $voiceRegion;
        $this->options['friendlyName'] = $friendlyName;
    }

    /**
     * The voice_region
     *
     * @param string $voiceRegion The voice_region
     * @return $this Fluent Builder
     */
    public function setVoiceRegion(string $voiceRegion): self {
        $this->options['voiceRegion'] = $voiceRegion;
        return $this;
    }

    /**
     * The friendly_name
     *
     * @param string $friendlyName The friendly_name
     * @return $this Fluent Builder
     */
    public function setFriendlyName(string $friendlyName): self {
        $this->options['friendlyName'] = $friendlyName;
        return $this;
    }

    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString(): string {
        $options = \http_build_query(Values::of($this->options), '', ' ');
        return '[Twilio.Routes.V2.UpdateSipDomainOptions ' . $options . ']';
    }
}