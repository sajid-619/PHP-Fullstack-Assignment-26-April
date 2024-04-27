import { useState, useEffect } from 'react';
import axios from 'axios';
import './BookList.css';

const BookList = () => {
  const [books, setBooks] = useState([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState(null);
  const [page, setPage] = useState(1);
  const [hasMore, setHasMore] = useState(true);

  useEffect(() => {
    const fetchBooks = async () => {
      try {
        const response = await axios.get(`${process.env.REACT_APP_API_URL}/books?page=${page}`);
        const newBooks = response.data;
        setBooks(prevBooks => [...prevBooks, ...newBooks]);
        setLoading(false);
        if (newBooks.length === 0) {
          setHasMore(false);
        }
      } catch (error) {
        setError(error);
        setLoading(false);
      }
    };

    fetchBooks();

  }, [page]);

  const handleScroll = () => {
    if (
      window.innerHeight + document.documentElement.scrollTop === document.documentElement.offsetHeight
    ) {
      setPage(prevPage => prevPage + 1);
    }
  };

  useEffect(() => {
    window.addEventListener('scroll', handleScroll);
    return () => {
      window.removeEventListener('scroll', handleScroll);
    };
  }, []);

  if (loading) {
    return <p>Loading...</p>;
  }

  if (error) {
    return <p>Error: Failed to fetch books. Please try again later.</p>;
  }

  return (
    <div>
      <h2>Books</h2>
      <ul>
        {books.map(book => (
          <li key={book.id}>
            <strong>Title:</strong> {book.title} <br />
            <strong>Writer:</strong> {book.writer} <br />
            <strong>Price:</strong> ${book.price} <br />
            <strong>Tags:</strong> {book.tags.join(', ')}
          </li>
        ))}
      </ul>
      {!hasMore && <p>No more books to fetch</p>}
    </div>
  );
};

export default BookList;
