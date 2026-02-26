import React, { useEffect, useState } from 'react';

import soundfile from '../../../../audios/analog-watch-alarm.mp3';
import './timer.style.css';

const Timer = () => {
    const [seconds, setSeconds] = useState(0);
    const [minutes, setMinutes] = useState(25);
    const [timer, setTimer] = useState(false);
    const audio = new Audio(soundfile);

    function updateTime() {
      if (timer) {
        if (minutes === 0 && seconds === 0) {
          setSeconds(0);
          setMinutes(25);
          setTimer(false);
          Notification.requestPermission().then(function (permission) {
            if (permission === 'granted') {
              audio.play();
              new Notification('The pomodoro has finished, please rest 5 minutes.');
            }
          });
        }
        else {
          if (seconds === 0) {
            setMinutes(minutes => minutes - 1);
            setSeconds(59);
          } else {
            setSeconds(seconds => seconds - 1);
          }
        }
      }
    }

    useEffect(() => {
      const countDown = setTimeout(updateTime, 1000)

      return function cleanUp() {
        clearTimeout(countDown);
      }
    })

    return (
      <div className="timer-container">
        <h1 className="text-center">Pomodoro</h1>
        <div className="card flex justify-content-center column items-center box-shadow">
          <h1>{minutes < 10 ? '0'+minutes : minutes === 0 ? '00' : minutes}:{seconds < 10 ? '0'+seconds : seconds === 0 ? '00' : seconds}</h1>
          <div>
            <button type="button" onClick={() => {setTimer(true);}}>Start</button>
            <button type="button" onClick={() => {setMinutes(25); setSeconds(0);}}>Restart</button>
            <button type="button" onClick={() => window.open('https://www.youtube.com/watch?v=5qap5aO4i9A&ab_channel=LofiGirl')}>Play lofi music</button>
          </div>
        </div>
      </div>
    );    
}

export default Timer;