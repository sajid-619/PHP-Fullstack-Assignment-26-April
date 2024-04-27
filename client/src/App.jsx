//import React from 'react';
import BookList from './components/BookList';
import CustomerList from './components/CustomerList';
import OrderList from './components/OrderList';

const App = () => {
  return (
    <div>
      <h1>Bookstore App</h1>
      <div className="lists-container">
        <BookList />
        <CustomerList />
        <OrderList />
      </div>
    </div>
  );
};

export default App;
