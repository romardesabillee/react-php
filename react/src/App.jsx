import { useEffect, useState } from 'react'
import './App.css'
import axios from 'axios';
import { API_URL } from './helper/config';

function App() {
  const [todo, setTodos] = useState([]);
  const [isLoading, setIsLoading] = useState('');

  const [title, setTitle] = useState('');
  const [description, setDescription] = useState('');

  useEffect(() => {
    setIsLoading('Getting all data...')
    axios.get(`${API_URL}/react-php/api/index.php`)
    .then((response) => {
      setTodos(response.data);
      console.log(response.data)
      setIsLoading('');
    }).catch((error) => {
      setIsLoading('');
    })
  }, [])

  function saveTodo(){
    setIsLoading('Saving data...')
    axios.post(`${API_URL}/react-php/api/index.php`, {
      title: title,
      description: description,
    })
    .then((response) => {
      setTodos([...todo, response.data]);
      setIsLoading('');
      setTitle('');
      setDescription('');
    }).catch((error) => {
      setIsLoading('');
    })
  }

  return (
    <div>
      Title: 
      <input type="text" 
            value={title}
            onChange={(e) => setTitle(e.target.value)} 
      />
      <br/>
      Description: 
      <input type="text" 
            value={description}
            onChange={(e) => setDescription(e.target.value)} 
      />
      <br/>
      <button onClick={saveTodo}>Create Todo</button>
      <br/>
      <br/>


      {isLoading ? (
        <h1>{isLoading}</h1>
      ): (
        todo.map((todo) => {
          return (
            <div key={todo.id}>
              <div>Title: {todo.title}</div>
              <p>Description: {todo.description}</p>
              <br/>
            </div>
          )
        })
      )}
    </div>
  )
}

export default App
