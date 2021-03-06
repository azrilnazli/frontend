<?php

namespace App\Jobs;

use App\Models\Video;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Log;
use File;

class ProcessVideo implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $id;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($id)
    {
        $this->id = $id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Log::info("Video Encoding Start : $this->id");

        // update videos.is_processing = 1
        $data['is_processing'] = 1;
        Video::where('id',$this->id)->update( $data);

        // start encoding using HandBrakeCLI

        // Start the clock time in seconds 
        $start_time = microtime(true);

        $encoder = app_path() . '/bin/HandBrakeCLI';
        $video_path = $video = public_path() . '/uploads/' . $this->id . '/videos';
        $video = $video_path . '/original.mp4';

        // encode for 1080p
        $command = "$encoder -i $video --preset=\"Vimeo YouTube HQ 1080p60\" --output $video_path/1080p.mp4";
        shell_exec($command);
        Log::info("1080p done : $$this->id");

        $command = "$encoder -i $video --preset=\"Vimeo YouTube HQ 720p60\" --output $video_path/720p.mp4";
        shell_exec($command);
        Log::info("720p done : $$this->id");

        $command = "$encoder -i $video --preset=\"Android 480p30\" --output $video_path/480p.mp4";
        shell_exec($command);
        Log::info("480p done : $$this->id");

        $command = "$encoder -i $video --preset=\"Apple 240p30\" --output $video_path/240p.mp4";
        shell_exec($command);
        Log::info("240p done : $$this->id");

        Log::info("Video Encoding End : $$this->id");

        // copy smil from public_app()/src/stream.smil to video folder
        $smil = public_path() . '/src/stream.smil';
        File::copy($smil, $video_path . '/stream.smil');

        // End the clock time in seconds 
        $end_time = microtime(true); 
        
        // Calculate the script execution time 
        $execution_time = ($end_time - $start_time); 

        // update time_taken
        $data['time_taken'] = $execution_time;
        Video::where('id',$this->id)->update($data);

        // update videos.is_ready = 1
        $data['is_ready'] = 1;
        Video::where('id',$this->id)->update( $data);
    }
}
