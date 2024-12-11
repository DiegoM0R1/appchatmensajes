// src/ChatList.js
import React from 'react';

function ChatList({ users, onSelectUser }) {
    return (
        <div className="chat-list">
            <h2>Usuarios</h2>
            <ul>
                {users.map(user => (
                    <li key={user.id} onClick={() => onSelectUser(user.id)}>
                        {user.name}
                    </li>
                ))}
            </ul>
        </div>
    );
}

export default ChatList;

