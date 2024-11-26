import React, { useEffect, useRef, useState } from 'react';
import SimplePeer from 'simple-peer';

function VideoCall({ roomId }) {
  const [stream, setStream] = useState(null);
  const [peer, setPeer] = useState(null);
  const myVideo = useRef();
  const remoteVideo = useRef();

  useEffect(() => {
    const startCall = async () => {
      try {
        const stream = await navigator.mediaDevices.getUserMedia({ 
          video: true, 
          audio: true 
        });
        setStream(stream);
        myVideo.current.srcObject = stream;

        const newPeer = new SimplePeer({
          initiator: window.location.hash === '#init',
          trickle: false,
          stream,
        });

        newPeer.on('signal', data => {
          // Send signal data to server
          console.log('Signal data:', data);
        });

        newPeer.on('stream', remoteStream => {
          remoteVideo.current.srcObject = remoteStream;
        });

        setPeer(newPeer);
      } catch (err) {
        console.error('Error accessing media devices:', err);
      }
    };

    startCall();

    return () => {
      if (stream) {
        stream.getTracks().forEach(track => track.stop());
      }
    };
  }, [roomId]);

  return (
    <div className="grid grid-cols-2 gap-4 p-4">
      <div className="relative">
        <video
          ref={myVideo}
          autoPlay
          muted
          playsInline
          className="w-full rounded-lg"
        />
        <span className="absolute bottom-2 left-2 bg-black bg-opacity-50 text-white px-2 py-1 rounded">
          You
        </span>
      </div>
      <div className="relative">
        <video
          ref={remoteVideo}
          autoPlay
          playsInline
          className="w-full rounded-lg"
        />
        <span className="absolute bottom-2 left-2 bg-black bg-opacity-50 text-white px-2 py-1 rounded">
          Doctor
        </span>
      </div>
      <div className="col-span-2 flex justify-center space-x-4">
        <button className="bg-red-500 text-white px-4 py-2 rounded-full hover:bg-red-600">
          End Call
        </button>
        <button className="bg-gray-500 text-white px-4 py-2 rounded-full hover:bg-gray-600">
          Mute
        </button>
        <button className="bg-gray-500 text-white px-4 py-2 rounded-full hover:bg-gray-600">
          Turn Off Camera
        </button>
      </div>
    </div>
  );
}