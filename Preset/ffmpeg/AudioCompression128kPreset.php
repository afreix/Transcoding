<?php

namespace AC\Component\Transcoding\Preset\ffmpeg;

use AC\Component\Transcoding\Preset;

/**
 * For more information on this preset please visit this link: https://trac.handbrake.fr/wiki/BuiltInPresets#classic
 */
class AudioCompression128kPreset extends BasePreset
{
    protected $key = "ffmpeg.audio_compression_128k";
    protected $name = "Audio Compression 128k Preset";
    protected $description = "A ffmpeg preset that compresses an audio file to a bite rate of 128kb/s";

    /**
     * Specify the options for this specific preset
     */
    public function configure()
    {
        $this->setOptions(array(
			'-i' => '',
			'-ab' => '128k',
			'-o' => '',
        ));
    }

}