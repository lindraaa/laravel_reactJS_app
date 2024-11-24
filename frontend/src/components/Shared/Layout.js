import Container from 'react-bootstrap/Container';
import Navbar from 'react-bootstrap/Navbar';
function Layout(props){
    return<>
    <Navbar bg="dark" expand="lg" fixed='top'>
      <Container>
        <Navbar.Brand href="#" className='text-light'>Accounts</Navbar.Brand>
      </Container>
    </Navbar>
    <Container>{props.children}</Container>
    
    </>
}

export default Layout;