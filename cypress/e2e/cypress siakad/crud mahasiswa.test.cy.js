/// <reference types="cypress" />

describe('User can Open Mahasiswa List Page', () => {
    it('Index Mahasiswa List', () => {
        cy.visit("http://127.0.0.1:8000/mahasiswa");
        cy.get('h2').should('have.text','JURUSAN TEKNOLOGI INFORMASI-POLITEKNIK NEGERI MALANG');
    });
    it('Create Mahasiswa', () => {
        cy.visit("http://127.0.0.1:8000/mahasiswa");
        cy.get('.float-right > .btn').click();
        cy.get(':nth-child(2) > label').should('have.text','Nim');
        cy.get('#myForm > :nth-child(3) > label').should('have.text','Nama');
        cy.get('#myForm > :nth-child(4) > label').should('have.text','Kelas');
        cy.get(':nth-child(5) > label').should('have.text','Jurusan');
        cy.get(':nth-child(6) > label').should('have.text','Jenis Kelamin');
        cy.get(':nth-child(7) > label').should('have.text','Email');
        cy.get(':nth-child(8) > label').should('have.text','Alamat');
        cy.get('.card > :nth-child(3) > label').should('have.text','Tanggal Lahir');
        cy.get('.card > :nth-child(4) > label').should('have.text','Foto');
        cy.get('#Nim').type("204172200",{force:true});
        cy.get('#Nama').type("Clarisha Sandra",{force:true});
        cy.get('#Jurusan').type("Teknik Informatika",{force:true});
        cy.get('#jeniskelamin').type("Perempuan",{force:true});
        cy.get('#Email').type("clarisha@gmail.com",{force:true});
        cy.get('#Alamat').type("Kab. Nganjuk",{force:true});
        cy.get('#tanggallahir').type('2001-20-09',{force:true});
        cy.get('.btn').contains("Submit").and("be.enabled");
        
    });
    it('Show Mahasiswa List', () => {
        cy.visit("http://127.0.0.1:8000/mahasiswa");
        //show mahasiswa
        cy.get(':nth-child(2) > :nth-child(10) > form > .btn-info').click();
        cy.get('.card-header').contains('Detail Mahasiswa').and('be.visible');
        cy.get('.list-group > :nth-child(1)').contains('Nim: 2041720038').and('be.visible');
        cy.get('.list-group > :nth-child(2)').contains('Nama: Ardha Nur Azizah').and('be.visible');
        cy.get('.list-group > :nth-child(3)').contains('Email: naardha0@gmail.com').and('be.visible');
        //button kembali
        cy.get('.btn').click();
    });
    it('Edit Mahasiswa List', () => {
        cy.visit("http://127.0.0.1:8000/mahasiswa");
        //edit mahasiswa
        cy.get('.float-right > .btn').click();
        cy.get(':nth-child(2) > label').should('have.text','Nim');
        cy.get('#myForm > :nth-child(3) > label').should('have.text','Nama');
        cy.get('#myForm > :nth-child(4) > label').should('have.text','Kelas');
        cy.get(':nth-child(5) > label').should('have.text','Jurusan');
        cy.get(':nth-child(6) > label').should('have.text','Jenis Kelamin');
        cy.get(':nth-child(7) > label').should('have.text','Email');
        cy.get(':nth-child(8) > label').should('have.text','Alamat');
        cy.get('.card > :nth-child(3) > label').should('have.text','Tanggal Lahir');
        cy.get('.card > :nth-child(4) > label').should('have.text','Foto');
        cy.get('#Nim').type("204172200",{force:true});
        cy.get('#Nama').type("Clarisha Sandra",{force:true});
        cy.get('#Jurusan').type("Teknik Informatika",{force:true});
        cy.get('#jeniskelamin').type("Perempuan",{force:true});
        cy.get('#Email').type("clarisha@gmail.com",{force:true});
        cy.get('#Alamat').type("Kab. Nganjuk",{force:true});
        cy.get('#tanggallahir').type('2001-20-09',{force:true});
        cy.get('.btn').contains("Submit").and("be.enabled");
    });
    it('Delete Mahasiswa List', () => {
        cy.visit("http://127.0.0.1:8000/mahasiswa");
        //delete mahasiswa
        cy.get(':nth-child(3) > :nth-child(10) > form > .btn-danger').click();
    });


})