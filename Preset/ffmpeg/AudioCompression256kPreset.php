<?php

namespace AC\Component\Transcoding\Preset\ffmpeg;

use AC\Component\Transcoding\Preset;

/**
 * For more information on this preset please visit this link: https://trac.handbrake.fr/wiki/BuiltInPresets#classic
 */
class AudioCompression256kPreset extends BasePreset
{
    protected $key = "ffmpeg.audio_compression_256k";
    protected $name = "Audio Compression 256k Preset";
    protected $description = "A ffmpeg preset that compresses an audio file to a bite rate of 256kb/s";

    /**
     * Specify the options for this specific preset
     */
    public function configure()
    {
        $this->setOptions(array(
			'-i' => '',
			'-ab' => '256k',
			'-o' => '',
        ));
    }

}