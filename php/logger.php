<?php
    //Functions for logging warning and error messages across the site.
    //If the log file does not exist in /php/admin, it will be created.

    //A message queue to queue up messages to append to log.txt since 1
    //user at a time may be granted access to it (to remain concurrent)
    $log_queue = new SplQueue();

    //Log a message in log.txt
    function logMsg($msg)
    {
        //TODO: This logger has not been well tested!
        //TODO: Logger only keeps one line at a time.

        //First, add the message to the queue:
        global $log_queue;
        //Track the time the message was added to the queue, not when it was written
        //to the log file since it could take a while till logMsg() is called again:
        $msg = date("[m/d/Y h:i:sa] ") . $msg . "\n"; //12hr clock with am/pm (UTC).
        $log_queue->enqueue($msg);
        //Check if there is a lock on the log:
        $logfile = fopen($_SERVER['DOCUMENT_ROOT'] . "/php/admin/log.txt", "a");
        //If there isn't a lock, append all elements in the queue:
        if (flock($logfile, LOCK_EX))
        {
            //Then write each message into the log file:
            $log_queue->rewind(); //Point to the 1st msg
            $log_append = $logfile;
            //Append each message in the queue into the final string
            while(!$log_queue->isEmpty())
            {
                $log_append = $log_append . $log_queue->current();
                $log_queue->dequeue();
            }
            fwrite($logfile, $log_append);
            fflush($logfile);
            //Unlock the file:
            flock($logfile, LOCK_UN);
            fclose($logfile);
        }
        //If the file is locked, the msg was still queued, so just return.
    }

    //Read in messages from the log.
    //Returns all the messages in it
    function logGet()
    {
        //TODO: Maybe limit the number of messages pulled up by amount or date
        return file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/php/admin/log.txt");
    }

    //If the log file does not yet exist, one should be made at a time when no
    //other user might also be trying to create the log file at the same time.
    function makeLog()
    {
        //It will make it if it does not yet exist.
        $logfile = fopen($_SERVER['DOCUMENT_ROOT'] . '/php/admin/log.txt', 'w');
        fclose($logfile);
    }
?>