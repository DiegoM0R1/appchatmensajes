// src/ChatWindow.js
import React, { useState, useEffect } from 'react';
import axios from 'axios';

function ChatWindow({ userId }) {
    const [messages, setMessages] = useState([]);
    const [message, setMessage] = useState('');
    const [file, setFile] = useState(null);

    useEffect(() => {
        axios.get(`/chat/messages/${userId}`)
            .then(response => {
                setMessages(response.data);
            })
            .catch(error => {
                console.error('There was an error fetching the messages!', error);
            });
    }, [userId]);

    const sendMessage = () => {
        const formData = new FormData();
        formData.append('receiver_id', userId);
        formData.append('message', message);
        if (file) {
            formData.append('file', file);
        }

        axios.post('/chat/send', formData)
            .then(response => {
                setMessages([...messages, response.data]);
                setMessage('');
                setFile(null);
            })
            .catch(error => {
                console.error('There was an error sending the message!', error);
            });
    };

    return (
        <div className="chat-window">
            <div className="messages">
                {messages.map(msg => (
                    <div key={msg.id} className={msg.user_id === userId ? 'message received' : 'message sent'}>
                        {msg.message}
                    </div>
                ))}
            </div>
            <textarea value={message} onChange={(e) => setMessage(e.target.value)} />
            <input type="file" onChange={(e) => setFile(e.target.files[0])} />
            <button onClick={sendMessage}>Enviar</button>
        </div>
    );
}

export default ChatWindow;
