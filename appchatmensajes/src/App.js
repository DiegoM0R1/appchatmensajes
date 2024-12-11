// src/App.js
import React, { useState, useEffect } from 'react';
import axios from 'axios';
import ChatList from './ChatList';
import ChatWindow from './ChatWindow';

function App() {
    const [users, setUsers] = useState([]);
    const [selectedUser, setSelectedUser] = useState(null);

    useEffect(() => {
        axios.get('/chat')
            .then(response => {
                setUsers(response.data);
            })
            .catch(error => {
                console.error('There was an error fetching the users!', error);
            });
    }, []);

    return (
        <div className="App">
            <ChatList users={users} onSelectUser={setSelectedUser} />
            {selectedUser && <ChatWindow userId={selectedUser} />}
        </div>
    );
}

export default App;

